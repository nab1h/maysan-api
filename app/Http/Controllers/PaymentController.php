<?php

namespace App\Http\Controllers;

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
            'offer_id' => 'nullable',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
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
            'message' => 'حدث خطأ أثناء إنشاء عملية الدفع',
        ], 400);
    }

    public function callBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $response = $this->paymentService->callBack($request);

        if ($response) {
            return redirect()->route('payment.success');
        }

        return redirect()->route('payment.failed');
    }

    public function success()
    {
        return view('payment-success');
    }

    public function failed()
    {
        return view('payment-failed');
    }
}
