<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // ✅ 1. إنشاء الحجز في الداتابيز أولاً قبل إرسال الطلب لـ Tap
        $reservation = Reservation::create([
            'name'             => $request->customer_name,
            'phone'            => $request->customer_phone,
            'email'            => $request->customer_email,
            'branch_id'        => $request->branch_id,
            'department_id'    => $request->department_id,
            'service_id'       => $request->service_id,
            'offer_id'         => $request->offer_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'status'           => 'pending',
            'payment_status'   => 'pending',   // قيد الانتظار لحد ما يدفع
            'payment_method'   => 'online',    // دفع إلكتروني
            'is_archive'       => 0,
            'is_delete'        => 0,
        ]);

        // ✅ 2. بناء الـ Payload بالشكل المطلوب لـ Tap
        $data = [
            'amount' => $request->amount,
            'currency' => 'SAR',
            'threeDSecure' => true,
            'save_card' => false,
            'description' => $request->description ?? 'حجز خدمة - عيادة ميثان',
            'statement_descriptor' => 'عيادة ميثان',
            'reference' => [
                'transaction' => 'RES-' . $reservation->id,
                'order' => (string) $reservation->id,
            ],
            'receipt' => [
                'email' => true,
                'sms' => true,
            ],
            'customer' => [
                'first_name' => $request->customer_name,
                'middle_name' => '',
                'last_name' => '',
                'email' => $request->customer_email,
                'phone' => [
                    'country_code' => '966',
                    'number' => $request->customer_phone,
                ],
            ],
            'source' => [
                'id' => 'src_all'
            ],
            'redirect' => [
                'url' => $request->getSchemeAndHttpHost() . '/payment/callback'
            ],
            'metadata' => [
                'reservation_id' => (string) $reservation->id,
                'offer_id' => $request->offer_id,
            ]
        ];

        // ✅ 3. إرسال الطلب لـ Tap
        $response = $this->buildRequest('POST', '/v2/charges/', $data);

        // ✅ 4. معالجة الرد
        if ($response->getData(true)['success']) {

            // حفظ رقم العملية من Tap في الحجز
            $transactionId = $response->getData(true)['data']['id'] ?? null;
            $reservation->update([
                'transaction_id' => $transactionId,
            ]);

            return [
                'success' => true,
                'url' => $response->getData(true)['data']['transaction']['url']
            ];
        }

        // لو فشل إنشاء الفاتورة، حدّث حالة الحجز
        $reservation->update(['payment_status' => 'failed']);

        return [
            'success' => false,
            'url' => route('payment.failed')
        ];
    }

    public function callBack(Request $request): bool
    {
        $chargeId = $request->input('tap_id');

        if (!$chargeId) {
            return false;
        }

        // ✅ الاستعلام عن حالة الدفع من Tap مباشرة
        $response = $this->buildRequest('GET', "/v2/charges/$chargeId");
        $response_data = $response->getData(true);

        // حفظ الرد للمراجعة
        Storage::put('tap_response_' . $chargeId . '.json', json_encode([
            'callback_response' => $request->all(),
            'response' => $response_data
        ]));

        // ✅ لو الدفع تم بنجاح
        if ($response_data['success'] && isset($response_data['data']['status']) && $response_data['data']['status'] == 'CAPTURED') {

            // البحث عن الحجز عن طريق رقم العملية
            $transactionId = $response_data['data']['id'];
            $reservation = Reservation::where('transaction_id', $transactionId)->first();

            if ($reservation) {
                $reservation->update([
                    'payment_status' => 'paid',       // ✅ تم الدفع
                    'status' => 'confirmed',          // ✅ تأكيد الحجز تلقائياً
                ]);
            }

            return true;
        }

        // ✅ لو الدفع فشل أو أُلغي
        if (isset($response_data['data']['status']) && in_array($response_data['data']['status'], ['FAILED', 'DECLINED', 'VOID', 'ABANDONED'])) {

            $transactionId = $response_data['data']['id'] ?? null;
            if ($transactionId) {
                $reservation = Reservation::where('transaction_id', $transactionId)->first();
                if ($reservation) {
                    $reservation->update([
                        'payment_status' => 'failed',    // ✅ فشل الدفع
                        'status' => 'cancelled',         // ✅ إلغاء الحجز
                    ]);
                }
            }
        }

        return false;
    }
}
