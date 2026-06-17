<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('branch')->latest()->paginate(10);
        $branches = Branch::all();
        return view('admin.users.index', compact('users', 'branches'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|string|in:admin,sales,user',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('status', 'تم تحديث بيانات المستخدم بنجاح!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('users.index')->with('status', 'تم تغيير كلمة المرور بنجاح!');
    }

    public function destroy(User $user)
    {
       if ($user && $user->id === auth()->id()) {
            return redirect()->back()->with('error', 'لا يمكنك حذف حسابك الخاص!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('status', 'تم حذف المستخدم بنجاح!');
    }
}
