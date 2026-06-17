<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:departments,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.unique'   => 'اسم القسم موجود بالفعل',
            'image.image'   => 'الملف يجب أن يكون صورة',
            'image.mimes'   => 'صيغة الصورة يجب أن تكون jpeg, png, jpg, webp',
            'image.max'     => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('departments', 'public');
        }

        Department::create($data);

        return redirect()->route('admin.departments.index')
            ->with('status', 'تم إضافة القسم بنجاح');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:departments,name,' . $department->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.unique'   => 'اسم القسم موجود بالفعل',
            'image.image'   => 'الملف يجب أن يكون صورة',
            'image.mimes'   => 'صيغة الصورة يجب أن تكون jpeg, png, jpg, webp',
            'image.max'     => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('image')) {
            if ($department->image) {
                Storage::disk('public')->delete($department->image);
            }
            $data['image'] = $request->file('image')->store('departments', 'public');
        }

        $department->update($data);

        return redirect()->route('admin.departments.index')
            ->with('status', 'تم تحديث القسم بنجاح');
    }

    public function destroy(Department $department)
    {
        if ($department->services()->count() > 0 || $department->articles()->count() > 0) {
            return redirect()->route('admin.departments.index')
                ->with('error', 'لا يمكن حذف هذا القسم لوجود خدمات أو مقالات مرتبطة به');
        }

        if ($department->image) {
            Storage::disk('public')->delete($department->image);
        }

        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('status', 'تم حذف القسم بنجاح');
    }
}
