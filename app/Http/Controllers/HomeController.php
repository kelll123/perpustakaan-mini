<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Sekarang VS Code tahu variabel $user punya borrowings
        $borrowings = $user->borrowings()->with('book')->latest()->get();

        return view('member.dashboard', compact('borrowings'));
    }
}
