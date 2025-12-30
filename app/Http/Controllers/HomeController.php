<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Arahkan Admin ke Dashboard Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Arahkan Staff ke Dashboard Staff
        if ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        // 3. Logika untuk Member
        $userId = Auth::id();

        /* CATATAN PENTING: 
           Jika baris di bawah ini error, itu karena tabel 'borrowings' 
           belum Anda buat di database perpustakaan_mini.sql
        */
        try {
            $activeBorrows = Borrowing::with('book')
                ->where('user_id', $userId)
                ->where('status', 'dipinjam')
                ->get();

            $historyBorrows = Borrowing::with('book')
                ->where('user_id', $userId)
                ->where('status', 'dikembalikan')
                ->latest()
                ->get();
        } catch (\Exception $e) {
            // Jika tabel belum ada, buat koleksi kosong agar tidak crash
            $activeBorrows = collect();
            $historyBorrows = collect();
        }

        // Gunakan 'members.dashboard' sesuai nama folder di VS Code Anda
        return view('members.dashboard', compact('activeBorrows', 'historyBorrows'));
    }
}
