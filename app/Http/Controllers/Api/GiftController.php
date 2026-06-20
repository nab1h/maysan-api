<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Services\TapPaymentService;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function __construct(private readonly TapPaymentService $paymentService)
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_national_id' => 'required|string|max:20',
            'sender_phone' => 'nullable|string|max:20',
            'sender_email' => 'nullable|email|max:255',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'message' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:1',
            'return_url' => 'nullable|string|max:1000',
        ]);

        $gift = Gift::create([
            ...$validated,
            'status' => 'pending',
        ]);

        $result = $this->paymentService->sendGiftPayment($request, $gift);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => 'Gift payment has been created successfully.',
                'url' => $result['url'],
                'data' => [
                    'gift' => $gift->fresh(),
                ],
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message'] ?? 'An error occurred while creating the gift payment.',
            'data' => [
                'gift' => $gift->fresh(),
            ],
        ], 400);
    }

    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'sender_national_id' => 'required|string|max:20',
        ]);

        $gifts = Gift::where('sender_national_id', $validated['sender_national_id'])
            ->latest()
            ->get()
            ->map(function (Gift $gift) {
                return [
                    'id' => $gift->id,
                    'sender_name' => $gift->sender_name,
                    'recipient_name' => $gift->recipient_name,
                    'recipient_phone' => $gift->recipient_phone,
                    'message' => $gift->message,
                    'amount' => $gift->amount,
                    'payment_status' => $gift->status,
                    'is_paid' => $gift->status === 'paid',
                    'is_consumed' => $gift->isConsumed(),
                    'consumed_at' => $gift->consumed_at?->toDateTimeString(),
                    'transaction_id' => $gift->transaction_id,
                    'created_at' => $gift->created_at?->toDateTimeString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'gifts' => $gifts,
            ],
        ]);
    }
}
