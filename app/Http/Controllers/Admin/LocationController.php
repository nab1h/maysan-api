<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }


    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
        ], [
            'name.required' => 'اسم المكان مطلوب',
            'name.unique' => 'اسم المكان موجود بالفعل',
            'name.max' => 'اسم المكان طويل جداً',
        ]);

        Location::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.locations.index')
            ->with('status', 'تم إضافة المكان بنجاح');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
        ], [
            'name.required' => 'اسم المكان مطلوب',
            'name.unique' => 'اسم المكان موجود بالفعل',
            'name.max' => 'اسم المكان طويل جداً',
        ]);

        $location->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.locations.index')
            ->with('status', 'تم تحديث المكان بنجاح');
    }


    public function destroy(Location $location)
    {
        if ($location->branches()->count() > 0) {
            return redirect()->route('admin.locations.index')
                ->with('error', 'لا يمكن حذف هذا المكان لوجود فروع مرتبطة به');
        }

        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('status', 'تم حذف المكان بنجاح');
    }
}
