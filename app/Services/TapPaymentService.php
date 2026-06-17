<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Reservation;
use App\Models\Payment; // ✅ إضافة موديل المدفوعات
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TapPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $api_key;

    public function __construct()
    {
        $this->base_url = env("TAP_BASE_URL");
        $this->api_key = env("TAP_API_KEY");
        $this->header = [
            'accept' => 'application/json',
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->api_key,
        ];
    }

    public function sendPayment(Request $request)
    {
        // ✅ 1. إنشاء سجل في جدول المدفوعات (Payment)
        $payment = Payment::create([
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'email' => $request->customer_email,
            'national_id' => $request->national_id,      // ✅ رقم الهوية
            'branch_id' => $request->branch_id,        // ✅ الفرع
            'service_id' => $request->service_id,       // ✅ الخدمة
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // ✅ 2. (اختياري) إنشاء سجل الحجز (Reservation) وربطه بالمدفوعات
        // إذا كنت تريد أن يظهر الحجز في صفحة الحجوزات أيضاً
        $reservation = Reservation::create([
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'email' => $request->customer_email,
            'national_id' => $request->national_id,
            'branch_id' => $request->branch_id,
            'department_id' => $request->department_id,
            'service_id' => $request->service_id,
            'offer_id' => $request->offer_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'online',
            'is_archive' => 0,
            'is_delete' => 0,
        ]);

        // ✅ 3. تنظيف رقم الجوال (مهم جداً لبوابة Tap)
        $phone = preg_replace('/[^0-9]/', '', $request->customer_phone);
        if (str_starts_with($phone, '05')) {
            $phone = substr($phone, 1);
        } elseif (str_starts_with($phone, '9665')) {
            $phone = substr($phone, 3);
        } elseif (str_starts_with($phone, '966')) {
            $phone = substr($phone, 3);
        }

        // ✅ 4. بناء الـ Payload
        $data = [
            'amount' => floatval($request->amount),
            'currency' => 'SAR',
            'threeDSecure' => true,
            'save_card' => false,
            'description' => $request->description ?? 'حجز خدمة - عيادة ميثان',
            'statement_descriptor' => 'عيادة ميثان',
            'reference' => [
                'transaction' => 'PAY-' . $payment->id,
                'order' => (string) $payment->id,
            ],
            'receipt' => [
                'email' => true,
                'sms' => true,
            ],
            'customer' => [
                'first_name' => $request->customer_name,
                'middle_name' => '',
                'last_name' => ' ',
                'email' => $request->customer_email,
                'phone' => [
                    'country_code' => '966',
                    'number' => $phone,
                ],
            ],
            'source' => [
                'id' => 'src_all'
            ],
            'redirect' => [
                'url' => $request->getSchemeAndHttpHost() . '/payment/callback'
            ],
            'metadata' => [
                'payment_id' => (string) $payment->id,
                'reservation_id' => (string) $reservation->id,
                'branch_id' => (string) $request->branch_id,
            ]
        ];

        // ✅ 5. إرسال الطلب لـ Tap
        $response = $this->buildRequest('POST', '/v2/charges/', $data);
        $responseData = $response->getData(true);

        // ✅ 6. معالجة الرد
        if ($responseData['success'] && isset($responseData['data']['transaction']['url'])) {

            $transactionId = $responseData['data']['id'] ?? null;

            // حفظ رقم العملية في جدول المدفوعات وجدول الحجوزات
            $payment->update(['transaction_id' => $transactionId]);
            $reservation->update(['transaction_id' => $transactionId]);

            return [
                'success' => true,
                'url' => $responseData['data']['transaction']['url']
            ];
        }

        // لو فشل إنشاء الفاتورة
        $payment->update(['status' => 'failed']);
        $reservation->update(['payment_status' => 'failed']);

        $errorMsg = 'خطأ غير معروف من Tap';
        if (isset($responseData['data']['errors'])) {
            $errorMsg = json_encode($responseData['data']['errors']);
        } elseif (isset($responseData['message'])) {
            $errorMsg = $responseData['message'];
        }

        return [
            'success' => false,
            'message' => $errorMsg,
        ];
    }

    public function callBack(Request $request): ?string
    {
        $chargeId = $request->input('tap_id');

        if (!$chargeId)
            return null;

        // الاستعلام عن حالة الدفع من Tap
        $response = $this->buildRequest('GET', "/v2/charges/$chargeId");
        $response_data = $response->getData(true);

        // حفظ الرد للمراجعة
        Storage::put('tap_response_' . $chargeId . '.json', json_encode([
            'callback_response' => $request->all(),
            'response' => $response_data
        ]));

        // ✅ لو الدفع تم بنجاح
        if ($response_data['success'] && isset($response_data['data']['status']) && $response_data['data']['status'] == 'CAPTURED') {

            $transactionId = $response_data['data']['id'];

            // تحديث جدول المدفوعات
            $payment = Payment::where('transaction_id', $transactionId)->first();
            if ($payment) {
                $payment->update(['status' => 'paid']);
            }

            // تحديث جدول الحجوزات
            $reservation = Reservation::where('transaction_id', $transactionId)->first();
            if ($reservation) {
                $reservation->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);
            }

            return $transactionId;
        }

        if (isset($response_data['data']['status']) && in_array($response_data['data']['status'], ['FAILED', 'DECLINED', 'VOID', 'ABANDONED'])) {

            $transactionId = $response_data['data']['id'] ?? null;
            if ($transactionId) {
                $payment = Payment::where('transaction_id', $transactionId)->first();
                if ($payment) {
                    $payment->update(['status' => 'failed']);
                }

                $reservation = Reservation::where('transaction_id', $transactionId)->first();
                if ($reservation) {
                    $reservation->update([
                        'payment_status' => 'failed',
                        'status' => 'cancelled',
                    ]);
                }
            }
        }

        return null;
    }
}
