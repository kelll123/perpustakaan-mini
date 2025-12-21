<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Kategori (Untuk Dropdown)
        $categories = Category::all();

        // 2. Query Buku (Search + Filter Kategori)
        $books = Book::with(['author', 'category'])
            // Filter Search Judul
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            // Filter Kategori (Dropdown)
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('id_category', $request->category_id);
            })
            // Hanya tampilkan buku yang statusnya 'aktif' (Opsional, tapi bagus untuk guest)
            ->where('status', 'aktif')
            ->latest()
            ->paginate(8) // Tampilkan 8 buku per halaman biar rapi
            ->withQueryString();

        return view('welcome', compact('books', 'categories'));
    }
    public function show($id)
    {
        // Cari buku berdasarkan ID, sekalian ambil data penulis dan kategori
        $book = Book::with(['author', 'category'])->findOrFail($id);

        // Tampilkan view detail
        return view('guest.detail', compact('book'));
    }
}
