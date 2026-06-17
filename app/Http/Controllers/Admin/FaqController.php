<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Department;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::with('department')->orderBy('order_column');

        // فلترة حسب القسم
        if ($request->has('department_id') && $request->department_id != '') {
            $query->where('department_id', $request->department_id);
        }

        $faqs = $query->get();
        $departments = Department::all(); // للفلتر في صفحة العرض

        return view('admin.faqs.index', compact('faqs', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.faqs.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'question_ar'   => 'required|string|max:255',
            'answer_ar'     => 'required|string',
            'order_column'  => 'nullable|integer',
        ], [
            'department_id.required' => 'يرجى اختيار القسم',
            'question_ar.required'   => 'السؤال بالعربي مطلوب',
            'answer_ar.required'     => 'الإجابة بالعربي مطلوبة',
        ]);

        Faq::create([
            'department_id' => $request->department_id,
            'question_ar'   => $request->question_ar,
            'answer_ar'     => $request->answer_ar,
            'order_column'  => $request->order_column ?? 0,
            'is_active'     => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.faqs.index')->with('status', 'تم إضافة السؤال بنجاح');
    }

    public function edit(Faq $faq)
    {
        $departments = Department::all();
        return view('admin.faqs.edit', compact('faq', 'departments'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'question_ar'   => 'required|string|max:255',
            'answer_ar'     => 'required|string',
            'order_column'  => 'nullable|integer',
        ]);

        $faq->update([
            'department_id' => $request->department_id,
            'question_ar'   => $request->question_ar,
            'answer_ar'     => $request->answer_ar,
            'order_column'  => $request->order_column ?? 0,
            'is_active'     => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.faqs.index')->with('status', 'تم تحديث السؤال بنجاح');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('status', 'تم حذف السؤال بنجاح');
    }
}
