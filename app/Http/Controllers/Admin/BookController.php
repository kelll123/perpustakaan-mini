<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // 1. Menampilkan Daftar Buku (SEARCH + FILTER KATEGORI)
    public function index(Request $request)
    {
      // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        // Query Buku
        $books = Book::with(['author', 'category'])
            // 1. Filter Pencarian Judul
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            // 2. Filter Kategori (INI YANG PENTING AGAR DROPDOWN BERFUNGSI)
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('id_category', $request->category_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.buku.index', compact('books', 'categories'));
    }

    // 2. Form Tambah Buku
    public function create()
    {
        $categories = Category::all();
        return view('admin.buku.create', compact('categories'));
    }

    // 3. Simpan Buku Baru
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title'       => 'required|string|max:255',
            'nama_author' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:aktif,nonaktif',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Gambar
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // Rapikan nama penulis
        $namaAuthor = Str::title(trim($request->nama_author));
        $author = Author::firstOrCreate(['nama_author' => $namaAuthor]);

        Book::create([
            'title'       => $request->title,
            'id_author'   => $author->id,
            'id_category' => $request->id_category,
            'stock'       => $request->stock,
            'deskripsi'   => $request->deskripsi,
            'status'      => $request->status,
            'cover'       => $coverPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 4. Form Edit Buku
    public function edit($id)
    {
        $book = Book::with('author')->findOrFail($id);
        $categories = Category::all();
        return view('admin.buku.edit', compact('book', 'categories'));
    }

    // 5. Update Buku
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'nama_author' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:aktif,nonaktif',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Rapikan nama penulis
        $namaAuthor = Str::title(trim($request->nama_author));
        $author = Author::firstOrCreate(['nama_author' => $namaAuthor]);

        $data = [
            'title'       => $request->title,
            'id_author'   => $author->id,
            'id_category' => $request->id_category,
            'stock'       => $request->stock,
            'deskripsi'   => $request->deskripsi,
            'status'      => $request->status,
        ];

        // LOGIKA UPDATE GAMBAR
        if ($request->hasFile('cover')) {
            // Hapus gambar lama
            if ($book->cover && Storage::exists('public/' . $book->cover)) {
                Storage::delete('public/' . $book->cover);
            }
            // Simpan gambar baru
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Simpan ID Author lama untuk dicek nanti
        $oldAuthorId = $book->id_author;

        $book->update($data);

        // HAPUS AUTHOR LAMA JIKA TIDAK PUNYA BUKU LAGI
        if ($oldAuthorId != $author->id) {
            $oldAuthor = Author::find($oldAuthorId);
            if ($oldAuthor && $oldAuthor->books()->count() == 0) {
                $oldAuthor->delete();
            }
        }

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    // 6. Hapus Buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Simpan ID penulis sebelum buku dihapus
        $authorId = $book->id_author;

        // Hapus Gambar Cover
        if ($book->cover && Storage::exists('public/' . $book->cover)) {
            Storage::delete('public/' . $book->cover);
        }

        // Hapus Buku
        $book->delete();

        // Cek Penulis: Jika penulis ini bukunya sudah 0 (habis), hapus penulisnya
        $author = Author::find($authorId);
        if ($author && $author->books()->count() == 0) {
            $author->delete();
        }

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
