<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;

class ClinicDataController extends Controller
{
    public function locations()
    {
        return response()->json([
            'success' => true,
            'data' => Location::select('id', 'name')->latest()->get(),
        ]);
    }

    public function branches(Request $request)
    {
        $branches = Branch::query()
            ->select('id', 'location_id', 'name', 'image', 'phone', 'instagram_url', 'google_map_url', 'address')
            ->with([
                'location:id,name',
                'departments:id,name,image',
            ])
            ->when($request->filled('location_id'), function ($query) use ($request) {
                $query->where('location_id', $request->input('location_id'));
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $branches,
        ]);
    }

    public function departments(Request $request)
    {
        $departments = Department::query()
            ->select('id', 'name', 'image')
            ->withCount('services')
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->whereHas('branches', function ($branchQuery) use ($request) {
                    $branchQuery->where('branches.id', $request->input('branch_id'));
                });
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $departments,
        ]);
    }

    public function services(Request $request)
    {
        $services = Service::query()
            ->select('id', 'department_id', 'name', 'image', 'price', 'description')
            ->with('department:id,name,image')
            ->when($request->filled('department_id'), function ($query) use ($request) {
                $query->where('department_id', $request->input('department_id'));
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }

    public function doctors(Request $request)
    {
        $doctors = Doctor::query()
            ->select('id', 'department_id', 'branch_id', 'name', 'image', 'description')
            ->with([
                'department:id,name,image',
                'branch:id,location_id,name,phone,address',
            ])
            ->when($request->filled('department_id'), function ($query) use ($request) {
                $query->where('department_id', $request->input('department_id'));
            })
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->input('branch_id'));
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $doctors,
        ]);
    }

    public function offers(Request $request)
    {
        $offers = Offer::query()
            ->select('id', 'branch_id', 'title', 'img', 'price', 'old_price', 'start_date', 'end_date')
            ->with('branch:id,location_id,name,phone,address')
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->input('branch_id'));
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $offers,
        ]);
    }
}
