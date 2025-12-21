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
        //Hitung Statistik
        $totalBuku      = Book::count();
        $totalUser      = User::where('role', 'staff')->count();
        $totalAuthor    = Author::count(); // Biasanya author dihitung semua, bukan cuma yg punya buku
        $totalCategory  = Category::count();
        $totalMembers   = User::where('role', 'member')->count();

        //AMBIL DATA BUKU (10 Terbaru)
        $books = Book::with(['author', 'category'])
            ->latest()
            ->limit(10)
            ->get();

        //Kirim ke View (Jangan lupa 'totalMembers' dimasukkan)
        return view('admin.dashboard', compact(
            'totalBuku', 
            'totalUser', 
            'totalAuthor', 
            'totalCategory', 
            'totalMembers', 
            'books'
        ));
    }
}