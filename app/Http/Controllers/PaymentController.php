<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Offer;
use App\Models\Payment;
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
            'return_url' => 'nullable|string|max:1000',
        ]);

        $amount = 0;
        $descriptionParts = [];

        if ($request->filled('service_id')) {
            $service = Service::find($request->service_id);
            $amount += (float) $service->price;
            $descriptionParts[] = $service->name;
        }

        if ($request->filled('offer_id')) {
            $offer = Offer::find($request->offer_id);
            $amount += (float) $offer->price;
            $descriptionParts[] = $offer->title;
        }

        if ($amount < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Please choose a service or offer with a valid price before online payment.',
            ], 422);
        }

        $request->merge([
            'amount' => $amount,
            'description' => $request->description ?: (implode(' + ', $descriptionParts) ?: 'Reservation appointment - Maysan Clinic'),
        ]);

        $result = $this->paymentService->sendPayment($request);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'url' => $result['url'],
                'amount' => $amount,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message'] ?? 'An error occurred while creating the payment.',
        ], 400);
    }

    public function callBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $transactionId = $this->paymentService->callBack($request);

        if ($transactionId) {
            $giftRedirect = $this->giftRedirect($transactionId, 'paid');
            if ($giftRedirect) {
                return redirect()->away($giftRedirect);
            }

            $paymentRedirect = $this->paymentRedirect($transactionId, 'paid');
            if ($paymentRedirect) {
                return redirect()->away($paymentRedirect);
            }

            return redirect()->route('payment.success', [
                'transaction_id' => $transactionId,
            ]);
        }

        if ($request->filled('tap_id')) {
            $giftRedirect = $this->giftRedirect($request->input('tap_id'), 'failed');
            if ($giftRedirect) {
                return redirect()->away($giftRedirect);
            }

            $paymentRedirect = $this->paymentRedirect($request->input('tap_id'), 'failed');
            if ($paymentRedirect) {
                return redirect()->away($paymentRedirect);
            }
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

    private function giftRedirect(string $transactionId, string $status): ?string
    {
        $gift = Gift::where('transaction_id', $transactionId)->first();

        if (!$gift || !$gift->return_url) {
            return null;
        }

        $separator = str_contains($gift->return_url, '?') ? '&' : '?';

        return $gift->return_url . $separator . http_build_query([
            'status' => $status,
            'transaction_id' => $transactionId,
            'gift_id' => $gift->id,
        ]);
    }

    private function paymentRedirect(string $transactionId, string $status): ?string
    {
        $payment = Payment::where('transaction_id', $transactionId)->first();

        if (!$payment || !$payment->return_url) {
            return null;
        }

        $separator = str_contains($payment->return_url, '?') ? '&' : '?';

        return $payment->return_url . $separator . http_build_query([
            'status' => $status,
            'transaction_id' => $transactionId,
            'payment_id' => $payment->id,
        ]);
    }
}
