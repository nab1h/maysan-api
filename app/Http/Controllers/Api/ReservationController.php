<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Offer;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function formOptions()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'locations' => Location::select('id', 'name')->get(),
                'branches' => Branch::select('id', 'location_id', 'name', 'phone', 'address')->get(),
                'departments' => Department::select('id', 'name')->get(),
                'services' => Service::select('id', 'department_id', 'name', 'price', 'description')->get(),
                'doctors' => Doctor::select('id', 'department_id', 'branch_id', 'name', 'description')->get(),
                'offers' => Offer::select('id', 'branch_id', 'title', 'price', 'old_price', 'start_date', 'end_date')->get(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'national_id' => 'nullable|string|max:10',
            'email' => 'nullable|email|max:255',
            'location_id' => 'nullable|exists:locations,id',
            'branch_id' => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'service_id' => 'nullable|exists:services,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'offer_id' => 'nullable|exists:offers,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'notes' => 'nullable|string',
            'message' => 'nullable|string',
            'payment_method' => 'nullable|in:cash,online',
            'payment_method_type' => 'nullable|in:cash,online',
        ]);

        $paymentMethod = $request->input('payment_method_type', $request->input('payment_method', 'cash'));

        $validated['status'] = 'pending';
        $validated['is_archive'] = 0;
        $validated['is_delete'] = 0;
        $validated['payment_method'] = $paymentMethod;
        $validated['payment_status'] = $paymentMethod === 'online' ? 'pending' : 'unpaid';

        unset($validated['payment_method_type']);

        $reservation = Reservation::create($validated)->load([
            'location',
            'branch',
            'department',
            'service',
            'doctor',
            'offer',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلب الحجز بنجاح! سنتواصل معك قريباً.',
            'data' => [
                'reservation' => $reservation,
            ],
        ], 201);
    }
}
