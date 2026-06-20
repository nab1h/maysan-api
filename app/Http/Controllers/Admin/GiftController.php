<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index(Request $request)
    {
        $query = Gift::query();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('sender_name', 'like', "%{$search}%")
                    ->orWhere('sender_national_id', 'like', "%{$search}%")
                    ->orWhere('recipient_name', 'like', "%{$search}%")
                    ->orWhere('recipient_phone', 'like', "%{$search}%")
                    ->orWhere('transaction_id', 'like', "%{$search}%");
            });
        }

        $gifts = $query->latest()->paginate(15)->withQueryString();

        $totalRevenue = Gift::where('status', 'paid')->sum('amount');
        $paidCount = Gift::where('status', 'paid')->count();
        $pendingCount = Gift::where('status', 'pending')->count();
        $failedCount = Gift::where('status', 'failed')->count();
        $consumedCount = Gift::whereNotNull('consumed_at')->count();

        return view('admin.gifts.index', compact('gifts', 'totalRevenue', 'paidCount', 'pendingCount', 'failedCount', 'consumedCount'));
    }

    public function consume(Gift $gift)
    {
        if ($gift->status !== 'paid') {
            return back()->with('error', 'لا يمكن استهلاك هدية غير مدفوعة.');
        }

        if ($gift->isConsumed()) {
            return back()->with('info', 'هذه الهدية تم استهلاكها من قبل.');
        }

        $gift->update([
            'consumed_at' => now(),
            'consumed_by' => auth()->id(),
        ]);

        return back()->with('success', 'تم تأكيد استهلاك الهدية بنجاح.');
    }
}
