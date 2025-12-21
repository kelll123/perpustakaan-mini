<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function store(Request $request, $id)
    {
        // 1. Cari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // 2. Cek Stok Buku
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        // 3. Cek apakah user sedang meminjam buku yang sama (Opsional, biar gak dobel)
        $isBorrowed = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($isBorrowed) {
            return back()->with('error', 'Kamu sedang meminjam buku ini. Kembalikan dulu sebelum meminjam lagi.');
        }

        // 4. Simpan Data Peminjaman
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'borrow_date' => Carbon::now(), // Hari ini
            'return_date' => Carbon::now()->addDays(7), // Wajib kembali 7 hari lagi
            'status' => 'dipinjam',
        ]);

        // 5. Kurangi Stok Buku
        $book->decrement('stock');

        // 6. Redirect ke Dashboard Member
        return redirect()->route('home')->with('success', 'Berhasil meminjam buku! Selamat membaca.');
    }
}
