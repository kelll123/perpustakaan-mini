<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;     // Gunakan Model Book (Bukan Buku)
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Hitung total buku (Pastikan kolom 'status' sudah ada di tabel books, jika belum hapus where-nya)
        $totalBuku = Book::count(); 
        
        // Ambil 5 buku terbaru
        // Kita beri nama variabel '$books' agar cocok dengan error di view Anda
        $books = Book::with('author')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

        // Kirim '$books' ke view, bukan '$bukuTerbaru'
        return view('staff.dashboard', compact('totalBuku', 'books'));
    }
}