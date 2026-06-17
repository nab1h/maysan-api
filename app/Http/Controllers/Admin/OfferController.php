<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->get();
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('admin.offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'old_price'  => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'img'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'title.required'           => 'عنوان العرض مطلوب',
            'price.required'           => 'السعر الجديد مطلوب',
            'price.numeric'            => 'السعر يجب أن يكون رقماً',
            'old_price.numeric'        => 'السعر القديم يجب أن يكون رقماً',
            'start_date.required'      => 'تاريخ البداية مطلوب',
            'end_date.required'        => 'تاريخ النهاية مطلوب',
            'end_date.after_or_equal'  => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
            'img.image'                => 'الملف يجب أن يكون صورة',
            'img.max'                  => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
        ]);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('offers', 'public');
        }

        Offer::create($data);

        return redirect()->route('admin.offers.index')
            ->with('status', 'تم إضافة العرض بنجاح');
    }

    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'old_price'  => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'img'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'title.required'           => 'عنوان العرض مطلوب',
            'end_date.after_or_equal'  => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
        ]);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            if ($offer->img) {
                Storage::disk('public')->delete($offer->img);
            }
            $data['img'] = $request->file('img')->store('offers', 'public');
        }

        $offer->update($data);

        return redirect()->route('admin.offers.index')
            ->with('status', 'تم تحديث العرض بنجاح');
    }

    public function destroy(Offer $offer)
    {
        if ($offer->img) {
            Storage::disk('public')->delete($offer->img);
        }

        $offer->delete();

        return redirect()->route('admin.offers.index')
            ->with('status', 'تم حذف العرض بنجاح');
    }
}
