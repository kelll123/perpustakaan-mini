<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK (Kode Lama Anda)
        $totalBuku      = Book::count();
        $totalUser      = User::where('role', 'staff')->count(); // Total Staff
        $totalAuthor    = Author::count();
        $totalCategory  = Category::count();
        $totalMembers   = User::where('role', 'member')->count();

        // 2. DATA BUKU TERBARU (Kode Lama Anda - Opsional ditampilkan)
        $books = Book::with(['author', 'category'])
            ->latest()
            ->limit(10)
            ->get();

        // 3. FITUR BARU: DAFTAR PEMINJAM AKTIF
        // Mengambil data peminjaman yang statusnya masih 'dipinjam'
        $ongoingBorrows = Borrowing::with(['user', 'book'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        // Kirim semua variabel ke View
        return view('admin.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalAuthor',
            'totalCategory',
            'totalMembers',
            'books',
            'ongoingBorrows'
        ));
    }

    // 4. FITUR BARU: PROSES PENGEMBALIAN BUKU
    public function returnBook($id)
    {
        // 1. Cari data peminjaman
        $borrow = Borrowing::with('book')->findOrFail($id);

        // 2. Cek apakah statusnya memang belum dikembalikan (Supaya stok ga nambah terus kalau di-refresh)
        if ($borrow->status !== 'dikembalikan') {

            // Ubah status jadi dikembalikan
            $borrow->status = 'dikembalikan';
            $borrow->save();

            // 3. KEMBALIKAN STOK BUKU (Ini bagian kuncinya)
            $book = $borrow->book; // Ambil data buku terkait

            if ($book) {
                $book->stock = $book->stock + 1; // Tambah stok 1
                $book->save(); // Simpan ke database
            }
        }

        return redirect()->back()->with('success', 'Buku diterima & Stok telah dikembalikan!');
    }
}
