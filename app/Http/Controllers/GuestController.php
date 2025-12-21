<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data buku, jika ada pencarian (search) filter datanya
        $books = Book::with(['category', 'author'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->where('status', 'aktif') // Hanya tampilkan buku aktif
            ->latest()
            ->paginate(8); // Tampilkan 8 buku per halaman

        return view('guest.index', compact('books'));
    }
    public function show($id)
    {
        // Cari buku berdasarkan ID, sekalian ambil data penulis dan kategori
        $book = Book::with(['author', 'category'])->findOrFail($id);

        // Tampilkan view detail
        return view('guest.detail', compact('book'));
    }
}
