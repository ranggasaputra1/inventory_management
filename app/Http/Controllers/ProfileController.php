<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            "tittle" => "Profile",
            "active_menu" => "profile"
        ]);
    }

    public function update(Request $request)
    {
        // Tentukan aturan validasi
        $rules = [
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'current_password' is required only if new_password is provided
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ];

        // Validasi input
        $request->validate($rules);

        $user = Auth::user();

        // Cek jika password baru diisi
        if ($request->filled('new_password')) {
            // Validasi jika password lama diisi
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
        }

        // Update foto profil jika diupload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('public/profile_pictures', 'public');
            $user->profile_picture = $profilePicture;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
