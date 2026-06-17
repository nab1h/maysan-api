<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use App\Models\Branch;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $reels = Reel::with('branch')->latest()->get();
        } else {
            $reels = Reel::with('branch')->where('branch_id', $user->branch_id)->latest()->get();
        }

        return view('admin.reels.index', compact('reels'));
    }

    public function create()
    {
        $user = auth()->user();
        $branches = ($user->role === 'admin') ? Branch::all() : Branch::where('id', $user->branch_id)->get();

        return view('admin.reels.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $user = auth()->user();
        $branch_id = $request->branch_id;

        if ($user->role !== 'admin' && $branch_id != $user->branch_id) {
            abort(403, 'غير مسموح لك بهذا الإجراء');
        }

        Reel::create(['url' => $request->url, 'branch_id' => $branch_id]);

        return redirect()->route('admin.reels.index')->with('success', 'تم إضافة الفيديو بنجاح');
    }

    public function edit(Reel $reel)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $reel->branch_id != $user->branch_id) {
            abort(403);
        }

        $branches = ($user->role === 'admin') ? Branch::all() : Branch::where('id', $user->branch_id)->get();

        return view('admin.reels.edit', compact('reel', 'branches'));
    }

    public function update(Request $request, Reel $reel)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $reel->branch_id != $user->branch_id) {
            abort(403);
        }

        $request->validate([
            'url' => 'required|url',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $branch_id = $request->branch_id;
        if ($user->role !== 'admin' && $branch_id != $user->branch_id) {
            abort(403);
        }

        $reel->update(['url' => $request->url, 'branch_id' => $branch_id]);

        return redirect()->route('admin.reels.index')->with('success', 'تم تعديل الفيديو بنجاح');
    }

    public function destroy(Reel $reel)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $reel->branch_id != $user->branch_id) {
            abort(403);
        }

        $reel->delete();
        return redirect()->route('admin.reels.index')->with('success', 'تم حذف الفيديو بنجاح');
    }
}
