<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Location;
use App\Models\Offer;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\BeforeAfter;

class ClinicDataController extends Controller
{
    public function locations()
    {
        return response()->json([
            'success' => true,
            'data' => Location::select('id', 'name')->latest()->get(),
        ]);
    }

    public function contactLinks()
    {
        $setting = Setting::query()
            ->select('facebook', 'twitter', 'instagram', 'snapchat', 'tiktok', 'mobile', 'whatsapp')
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'phone' => $setting?->mobile,
                'whatsapp' => $setting?->whatsapp,
                'social_media' => [
                    'facebook' => $setting?->facebook,
                    'twitter' => $setting?->twitter,
                    'instagram' => $setting?->instagram,
                    'snapchat' => $setting?->snapchat,
                    'tiktok' => $setting?->tiktok,
                ],
            ],
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

    public function branchDepartments(Request $request)
    {
        $branches = Branch::query()
            ->select('id', 'location_id', 'name', 'phone', 'address')
            ->with([
                'location:id,name',
                'departments:id,name,image',
            ])
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('id', $request->input('branch_id'));
            })
            ->latest()
            ->get();

        $branchDepartments = $branches->flatMap(function (Branch $branch) {
            return $branch->departments->map(function (Department $department) use ($branch) {
                return [
                    'branch_id' => $branch->id,
                    'branch' => [
                        'id' => $branch->id,
                        'location_id' => $branch->location_id,
                        'location' => $branch->location,
                        'name' => $branch->name,
                        'phone' => $branch->phone,
                        'address' => $branch->address,
                    ],
                    'department_id' => $department->id,
                    'department' => [
                        'id' => $department->id,
                        'name' => $department->name,
                        'image' => $department->image,
                    ],
                ];
            });
        })->values();

        return response()->json([
            'success' => true,
            'data' => $branchDepartments,
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
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->whereHas('department.branches', function ($branchQuery) use ($request) {
                    $branchQuery->where('branches.id', $request->input('branch_id'));
                });
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }

    public function branchServices(Request $request)
    {
        $branches = Branch::query()
            ->select('id', 'location_id', 'name', 'phone', 'address')
            ->with([
                'departments:id,name',
                'departments.services:id,department_id,name,image,price,description',
            ])
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('id', $request->input('branch_id'));
            })
            ->latest()
            ->get();

        $branchServices = $branches->flatMap(function (Branch $branch) {
            return $branch->departments->flatMap(function (Department $department) use ($branch) {
                return $department->services->map(function (Service $service) use ($branch, $department) {
                    return [
                        'branch_id' => $branch->id,
                        'branch' => [
                            'id' => $branch->id,
                            'location_id' => $branch->location_id,
                            'name' => $branch->name,
                            'phone' => $branch->phone,
                            'address' => $branch->address,
                        ],
                        'department_id' => $department->id,
                        'department' => [
                            'id' => $department->id,
                            'name' => $department->name,
                        ],
                        'service_id' => $service->id,
                        'service' => [
                            'id' => $service->id,
                            'department_id' => $service->department_id,
                            'name' => $service->name,
                            'image' => $service->image,
                            'price' => $service->price,
                            'description' => $service->description,
                        ],
                    ];
                });
            });
        })->values();

        return response()->json([
            'success' => true,
            'data' => $branchServices,
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


    public function beforeAfters()
    {
        $beforeAfters = BeforeAfter::query()
            ->latest()
            ->take(8)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $beforeAfters,
        ]);
    }

}
