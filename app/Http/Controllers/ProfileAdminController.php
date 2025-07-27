<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        return view('components.profileadmin.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::user();
        $admin->username = $request->username;
        $admin->name     = $request->name;
        $admin->email    = $request->email;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $avatarPath;
        }

        $admin->save();

        return redirect()->route('profileadmin.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('profileadmin.index')->with('success', 'Password berhasil diubah.');
    }
}
