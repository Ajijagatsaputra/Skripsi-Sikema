<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('components.profileadmin', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
        ]);

        $admin = Auth::user();
        $admin->username = $request->username;
        $admin->email    = $request->email;
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
