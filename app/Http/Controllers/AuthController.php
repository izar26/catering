<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['username' => 'Username atau password salah.']);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showGantiPassword()
{
    return view('admin.auth.ganti-password');
}

// app/Http/Controllers/AuthController.php

public function gantiPassword(Request $request)
{
    // [DIUBAH] Aturan untuk password_baru kini lebih simpel
    $request->validate([
        'password_lama' => ['required', 'current_password'],
        'password_baru' => [
            'required',
            'different:password_lama',
            'min:8', // Syaratnya sekarang hanya minimal 8 karakter
            'confirmed',
        ],
    ], [
        // Pesan error kustom
        'password_lama.current_password' => 'Password lama yang Anda masukkan salah.',
        'password_baru.different' => 'Password baru tidak boleh sama dengan password lama.',
        'password_baru.min' => 'Password baru minimal harus 8 karakter.',
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password_baru);
    $user->save();

    return redirect()->back()->with('success', 'Password berhasil diperbarui.');
}
}

