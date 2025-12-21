<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Hitung Statistik (Kecuali Staff)
        $totalBuku      = Book::count();
        $totalAuthor    = Author::count();
        $totalCategory  = Category::count();
        $totalMembers   = User::where('role', 'member')->count();

        // Ambil 5 Buku Terbaru
        $books = Book::with(['author', 'category'])->latest()->limit(5)->get();

        return view('staff.dashboard', compact(
            'totalBuku',
            'totalAuthor',
            'totalCategory',
            'totalMembers',
            'books'
        ));
    }
}
