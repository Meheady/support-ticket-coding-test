<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.dashboard');
    }

    public function adminCreate()
    {
        return view('admin.user.create');
    }
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin',
        ]);

        return redirect()->route('admin.list')->with('success', 'Admin created successfully.');
    }

    public function allAdmin()
    {
        $admins = User::where('type', 'admin')->get();
        return view('admin.user.list', compact('admins'));
    }

    public function deleteAdmin($id)
    {
        $admin = User::findOrFail($id);

        if (auth()->id() === $admin->id) {
            return redirect()->route('admin.list')->with('error', 'You cannot delete own account.');
        }
        $admin->delete();
        return redirect()->route('admin.list')->with('success', 'Admin deleted successfully.');

    }
}
