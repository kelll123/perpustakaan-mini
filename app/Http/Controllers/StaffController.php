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

        // Ambil Peminjaman Aktif untuk Verifikasi Pengembalian
        $ongoingBorrows = Borrowing::with(['user', 'book'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('staff.dashboard', compact(
            'totalBuku',
            'totalAuthor',
            'totalCategory',
            'totalMembers',
            'books',
            'ongoingBorrows'
        ));
    }

    // Fungsi Staff menerima pengembalian buku
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        // Update status peminjaman
        $borrowing->update(['status' => 'dikembalikan']);

        // Tambahkan stok buku kembali
        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan dan stok diperbarui!');
    }

    public function members()
    {
        $totalMembers = User::where('role', 'member')->count();
        $members = User::where('role', 'member')->latest()->get();

        return view('staff.member.index', compact('totalMembers', 'members'));
    }

    // Fitur tambahan agar Staff bisa mengelola Penulis
    public function authors()
    {
        $authors = Author::withCount('books')->latest()->get();
        return view('staff.authors.index', compact('authors'));
    }

    // Fitur tambahan agar Staff bisa mengelola Kategori
    public function categories()
    {
        $categories = Category::withCount('books')->latest()->get();
        return view('staff.category.index', compact('categories'));
    }

    // Tambahkan ini di dalam class StaffController

    public function storeAuthor(Request $request)
    {
        $request->validate([
            'nama_author' => 'required|string|max:255|unique:authors,nama_author',
        ]);

        Author::create($request->all());

        return back()->with('success', 'Penulis baru berhasil ditambahkan!');
    }

    public function updateAuthor(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'nama_author' => 'required|string|max:255|unique:authors,nama_author,' . $id,
        ]);

        $author->update($request->all());

        return back()->with('success', 'Nama penulis berhasil diperbarui!');
    }

    public function destroyAuthor($id)
    {
        $author = Author::findOrFail($id);

        // Cek apakah penulis masih memiliki buku di database
        if ($author->books()->count() > 0) {
            return back()->with('error', 'Penulis tidak bisa dihapus karena masih terikat dengan beberapa koleksi buku.');
        }

        $author->delete();

        return back()->with('success', 'Data penulis berhasil dihapus!');
    }

    // Tambahkan fungsi ini di dalam class StaffController

    // 1. Simpan Kategori Baru
    public function storeCategory(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Nama kategori sudah ada!'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // 2. Update Kategori
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $id,
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    // 3. Hapus Kategori
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek apakah kategori masih dipakai oleh buku
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki koleksi buku!');
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
