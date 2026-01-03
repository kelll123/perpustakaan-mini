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

    // 1. Redirect berdasarkan Role
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'staff') return redirect()->route('staff.dashboard');

    // 2. Ambil Data untuk Member (dengan try-catch)
    try {
        $activeBorrows = Borrowing::with('book')
            ->where('user_id', $user->id) // Menggunakan $user->id dari objek yang sudah ada
            ->where('status', 'dipinjam')
            ->get();

        $historyBorrows = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'dikembalikan')
            ->latest()
            ->get();
    } catch (\Exception $e) {
        $activeBorrows = collect();
        $historyBorrows = collect();
    }

    return view('members.dashboard', compact('activeBorrows', 'historyBorrows'));
}
}
