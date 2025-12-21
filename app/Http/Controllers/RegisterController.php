<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Wajib import Hash
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan User Baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // PENTING: Password HARUS di-Hash agar bisa dipakai login
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        // 3. JANGAN Auto Login (Hapus baris Auth::login jika ingin manual)
        // Auth::login($user); <--- Baris ini dihapus/dikomentari

        // 4. Arahkan ke Halaman Login dengan Pesan Sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login dengan akun barumu.');
    }
}
