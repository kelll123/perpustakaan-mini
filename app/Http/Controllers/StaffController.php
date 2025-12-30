<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Borrowing;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Hitung Statistik
        $totalBuku      = Book::count();
        $totalAuthor    = Author::count();
        $totalCategory  = Category::count();
        $totalMembers   = User::where('role', 'member')->count();

        // Ambil 5 Buku Terbaru
        $books = Book::with(['author', 'category'])->latest()->limit(5)->get();

        // TAMBAHKAN INI: Ambil Peminjaman Aktif
        $ongoingBorrows = Borrowing::where('status', 'dipinjam')->get();

        return view('staff.dashboard', compact(
            'totalBuku',
            'totalAuthor',
            'totalCategory',
            'totalMembers',
            'books',
            'ongoingBorrows'
        ));
    }

    public function members()
    {
        // Mengambil data statistik untuk dashboard mini di atas tabel
        $totalMembers = User::where('role', 'member')->count();
        $members = User::where('role', 'member')->latest()->get();

        return view('staff.member.index', compact('totalMembers', 'members'));
    }
}
