<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Location;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Offer;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // =========================
    // Reservations Index
    // =========================
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Reservation::where('is_archive', 0)
            ->with(['location', 'branch', 'department', 'service', 'doctor', 'offer']); // ✅ أضفنا offer

        if ($user->role !== 'admin' && $user->branch_id) {
            $query->where('branch_id', $user->branch_id);
        } elseif ($user->role !== 'admin' && !$user->branch_id) {
            $query->whereRaw('1 = 0');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ✅ فلتر حسب حالة الدفع
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // ✅ فلتر حسب طريقة الدفع
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        $reservations = $query->latest()->paginate(10);

        $branchCondition = ($user->role !== 'admin' && $user->branch_id) ? ['branch_id' => $user->branch_id] : [];

        $totalReservations = Reservation::where($branchCondition)->count();
        $pending = Reservation::where('status', 'pending')->where($branchCondition)->count();
        $confirmed = Reservation::where('status', 'confirmed')->where($branchCondition)->count();
        $completed = Reservation::where('status', 'completed')->where($branchCondition)->count();
        $archive = Reservation::where('is_archive', true)->where($branchCondition)->count();

        // ✅ إحصائيات الدفع
        $paidCount = Reservation::where('payment_status', 'paid')->where($branchCondition)->count();
        $onlineCount = Reservation::where('payment_method', 'online')->where($branchCondition)->count();

        return view('admin.reservations.index', compact(
            'reservations',
            'totalReservations',
            'pending',
            'confirmed',
            'completed',
            'archive',
            'paidCount',
            'onlineCount'
        ));
    }

    public function confirmStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);

        return redirect()->back()->with('status', 'تم تأكيد الحجز بنجاح!');
    }

    public function completeStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'completed']);

        return redirect()->back()->with('status', 'تم تسجيل الحجز كمكتمل (تم الحضور)!');
    }

    // =========================
    // Create
    // =========================
    public function create()
    {
        $locations = Location::all();
        $branches = Branch::all();
        $departments = Department::all();
        $services = Service::all();
        $doctors = Doctor::all();
        $offers = Offer::all(); // ✅ أضفنا العروض

        return view('admin.reservations.create', compact(
            'locations',
            'branches',
            'departments',
            'services',
            'doctors',
            'offers'
        ));
    }

    // =========================
    // Store
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'location_id'       => 'nullable|exists:locations,id',
            'branch_id'         => 'nullable|exists:branches,id',
            'department_id'     => 'nullable|exists:departments,id',
            'service_id'        => 'nullable|exists:services,id',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'offer_id'          => 'nullable|exists:offers,id',
            'reservation_date'  => 'required|date|after_or_equal:today',
            'reservation_time'  => 'required',
            'notes'             => 'nullable|string',
            'message'           => 'nullable|string',
            'payment_method_type' => 'nullable|in:cash,online',
        ]);

        // ✅ تحديد طريقة الدفع وحالته
        $paymentMethod = $request->payment_method_type ?? 'cash';
        $paymentStatus = 'unpaid';

        if ($paymentMethod === 'online') {
            $paymentStatus = 'pending';
        }

        // ✅ إضافة الحقول الجديدة للبيانات المعتمدة
        $validated['status'] = 'pending';
        $validated['is_archive'] = 0;
        $validated['is_delete'] = 0;
        $validated['payment_method'] = $paymentMethod;
        $validated['payment_status'] = $paymentStatus;

        // ✅ إنشاء حجز واحد فقط
        Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلب الحجز بنجاح! سنتواصل معك قريباً.'
        ]);
    }

    // =========================
    // Edit
    // =========================
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        $locations = Location::all();
        $branches = Branch::all();
        $departments = Department::all();
        $services = Service::all();
        $doctors = Doctor::all();
        $offers = Offer::all();

        return view('admin.reservations.edit', compact(
            'reservation',
            'locations',
            'branches',
            'departments',
            'services',
            'doctors',
            'offers'
        ));
    }

    // =========================
    // Update
    // =========================
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'location_id'       => 'nullable|exists:locations,id',
            'branch_id'         => 'nullable|exists:branches,id',
            'department_id'     => 'nullable|exists:departments,id',
            'service_id'        => 'nullable|exists:services,id',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'offer_id'          => 'nullable|exists:offers,id',
            'reservation_date'  => 'required|date',
            'reservation_time'  => 'required',
            'status'            => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status'    => 'nullable|in:unpaid,pending,paid,failed',
            'payment_method'    => 'nullable|in:cash,online',
            'notes'             => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()
            ->route('reservations.index')
            ->with('status', 'تم تحديث الحجز بنجاح!');
    }

    // =========================
    // Delete
    // =========================
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()
            ->back()
            ->with('status', 'تم حذف الحجز نهائيًا!');
    }

    // =========================
    // Archive
    // =========================
    public function archive(Request $request)
    {
        $query = Reservation::where('is_archive', 1)
            ->with(['location', 'branch', 'department', 'service', 'doctor', 'offer']); // ✅ أضفنا offer

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        $reservations = $query->latest()->paginate(10);
        $totalArchived = Reservation::where('is_archive', 1)->count();

        return view('admin.reservations.archive', compact('reservations', 'totalArchived'));
    }

    public function moveToArchive($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_archive' => 1]);

        return redirect()->route('reservations.index')->with('status', 'تم أرشفة الحجز بنجاح!');
    }

    // =========================
    // Archived
    // =========================
    public function archived()
    {
        $reservations = Reservation::where('is_archive', 1)
            ->where('is_delete', 0)
            ->with(['location', 'branch', 'department', 'service', 'doctor', 'offer']) // ✅ أضفنا offer
            ->latest()
            ->paginate(10);

        return view('reservations.archived', compact('reservations'));
    }

    public function restore($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_archive' => 0]);

        return redirect()->route('reservations.archive')->with('status', 'تم استعادة الحجز بنجاح!');
    }
}
