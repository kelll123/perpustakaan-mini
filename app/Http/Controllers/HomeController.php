<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing; 
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Data yang SEDANG DIPINJAM
        $activeBorrows = Borrowing::with('book')
            ->where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->get();

        // 2. Data RIWAYAT (SUDAH KEMBALI)
        $historyBorrows = Borrowing::with('book')
            ->where('user_id', $userId)
            ->where('status', 'dikembalikan')
            ->latest()
            ->get();

        return view('member.dashboard', compact('activeBorrows', 'historyBorrows'));
    }
}
