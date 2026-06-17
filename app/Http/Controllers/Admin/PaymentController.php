<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['branch', 'service']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('phone', 'like', "%{$search}%")
                    ->orWhere('transaction_id', 'like', "%{$search}%")
                    ->orWhere('national_id', 'like', "%{$search}%");
            });
        }

        $payments = $query->latest()->paginate(15);

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $paidCount = Payment::where('status', 'paid')->count();
        $pendingCount = Payment::where('status', 'pending')->count();

        return view('admin.payments.index', compact('payments', 'totalRevenue', 'paidCount', 'pendingCount'));
    }
}
