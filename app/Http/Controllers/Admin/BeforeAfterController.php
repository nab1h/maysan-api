<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeforeAfter;
use Illuminate\Support\Facades\Storage;
class BeforeAfterController extends Controller
{

    public function index()
    {
        $results = BeforeAfter::all();
        return view('admin.before_afters.index', compact('results'));
    }

    public function create()
    {
        return view('admin.before_afters.create');
    }
    public function store(Request $request)

    {


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $imagePath = $request->file('image')->store('before_afters', 'public');

        BeforeAfter::create([
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.before-afters.index')->with('status', 'تم إضافة الصورة بنجاح!');
    }

    public function destroy(BeforeAfter $beforeAfter)
    {
        if ($beforeAfter->image) Storage::disk('public')->delete($beforeAfter->image);

        $beforeAfter->delete();

        return redirect()->back()->with('status', 'تم الحذف بنجاح!');
    }
}
