<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        // جلب الخدمات مع اسم القسم المرتبط بها (Eager Loading)
        $services = Service::with('department')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.services.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'department_id.required' => 'يرجى اختيار القسم',
            'department_id.exists'   => 'القسم المختار غير موجود',
            'name.required'          => 'اسم الخدمة مطلوب',
            'price.required'         => 'سعر الخدمة مطلوب',
            'price.numeric'          => 'السعر يجب أن يكون رقماً',
            'image.image'            => 'الملف يجب أن يكون صورة',
            'image.max'              => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'تم إضافة الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        $departments = Department::all();
        return view('admin.services.edit', compact('service', 'departments'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'department_id.required' => 'يرجى اختيار القسم',
            'name.required'          => 'اسم الخدمة مطلوب',
            'price.required'         => 'سعر الخدمة مطلوب',
            'price.numeric'          => 'السعر يجب أن يكون رقماً',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('status', 'تم حذف الخدمة بنجاح');
    }
}
