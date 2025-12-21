<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung Statistik
        $totalBuku = Book::count();
        $totalUser = User::where('role', 'staff')->count();
        $totalAuthor = Author::has('books')->count();
        $totalCategory = Category::count();

        // AMBIL DATA BUKU (Terbaru, limit 5 atau 10 untuk dashboard)
        $books = Book::with(['author', 'category'])
            ->latest()
            ->limit(10) // Kita batasi 10 buku terbaru agar dashboard tidak kepanjangan
            ->get();

        return view('admin.dashboard', compact('totalBuku', 'totalUser', 'totalAuthor', 'totalCategory', 'books'));
    }
}
