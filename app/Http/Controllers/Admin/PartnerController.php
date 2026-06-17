<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'nullable|string|max:255',
            'image'      => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'link'       => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
        ], [
            'image.required' => 'لوجو الشركة مطلوب',
            'image.image'    => 'الملف يجب أن يكون صورة',
            'link.url'       => 'رابط الموقع غير صالح',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('status', 'تم إضافة الشريك بنجاح');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'       => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'link'       => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($partner->image) {
                Storage::disk('public')->delete($partner->image);
            }
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('status', 'تم تحديث الشريك بنجاح');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->image) {
            Storage::disk('public')->delete($partner->image);
        }
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('status', 'تم حذف الشريك بنجاح');
    }
}
