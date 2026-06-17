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
            'national_id' => 'nullable|string|max:10',
            'branch_id' => 'nullable|exists:branches,id',
            'service_id' => 'nullable|exists:services,id',
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
