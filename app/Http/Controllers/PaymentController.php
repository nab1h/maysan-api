<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Service;
use App\Services\TapPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected TapPaymentService $paymentService;

    public function __construct(TapPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function paymentProcess(Request $request)
    {
        $request->validate([
            'offer_id' => 'nullable|exists:offers,id',
            'description' => 'nullable|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'national_id' => 'nullable|string|max:10',
            'location_id' => 'nullable|exists:locations,id',
            'branch_id' => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'service_id' => 'nullable|exists:services,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'reservation_date' => 'nullable|date|after_or_equal:today',
            'reservation_time' => 'nullable',
            'message' => 'nullable|string',
        ]);

        $priceSource = null;
        $description = $request->description;

        if ($request->filled('offer_id')) {
            $priceSource = Offer::find($request->offer_id);
            $description = $description ?: $priceSource?->title;
        } elseif ($request->filled('service_id')) {
            $priceSource = Service::find($request->service_id);
            $description = $description ?: $priceSource?->name;
        }

        if (!$priceSource || $priceSource->price < 1) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى اختيار خدمة أو عرض له سعر صحيح قبل الدفع الإلكتروني',
            ], 422);
        }

        $request->merge([
            'amount' => $priceSource->price,
            'description' => $description ?: 'حجز موعد - عيادة ميثان',
        ]);

        $result = $this->paymentService->sendPayment($request);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'url' => $result['url'],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message'] ?? 'حدث خطأ أثناء إنشاء عملية الدفع',
        ], 400);
    }

    public function callBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $transactionId = $this->paymentService->callBack($request);

        if ($transactionId) {
            return redirect()->route('payment.success', [
                'transaction_id' => $transactionId,
            ]);
        }

        return redirect()->route('payment.failed');
    }

    public function success(Request $request)
    {
        return view('payment-success', [
            'transactionId' => $request->query('transaction_id'),
        ]);
    }

    public function failed()
    {
        return view('payment-failed');
    }
}
