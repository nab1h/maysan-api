<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        // جلب الأطباء مع بيانات القسم والفرع لتحسين الأداء
        $doctors = Doctor::with(['department', 'branch'])->latest()->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        $branches = Branch::all();
        return view('admin.doctors.create', compact('departments', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'branch_id'     => 'required|exists:branches,id',
            'name'          => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'   => 'nullable|string',
        ], [
            'department_id.required' => 'يرجى اختيار القسم',
            'branch_id.required'     => 'يرجى اختيار الفرع',
            'name.required'          => 'اسم الطبيب مطلوب',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('status', 'تم إضافة الطبيب بنجاح');
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        $branches = Branch::all();
        return view('admin.doctors.edit', compact('doctor', 'departments', 'branches'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'branch_id'     => 'required|exists:branches,id',
            'name'          => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'   => 'nullable|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('status', 'تم تحديث بيانات الطبيب بنجاح');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image) {
            Storage::disk('public')->delete($doctor->image);
        }
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('status', 'تم حذف الطبيب بنجاح');
    }
}
