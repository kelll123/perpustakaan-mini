<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Tambahkan ini untuk manipulasi string

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->latest()->paginate(10);
        return view('staff.buku.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('staff.buku.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'nama_author' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:aktif,nonaktif',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // REVISI 1: NORMALISASI NAMA PENULIS
        // " tere liye " -> "Tere Liye" (Hapus spasi, huruf besar di awal kata)
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

        return redirect()->route('staff.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Book::with(['author', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('staff.buku.edit', compact('book', 'categories'));
    }

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

        // REVISI 1: NORMALISASI JUGA DI UPDATE
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

        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::exists('public/' . $book->cover)) {
                Storage::delete('public/' . $book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Simpan Author ID Lama untuk dicek nanti
        $oldAuthorId = $book->id_author;

        $book->update($data);

        // REVISI 2: BERSIHKAN AUTHOR LAMA JIKA TIDAK PUNYA BUKU LAGI
        // Jika penulis berubah, cek penulis lama. Kalau bukunya 0, hapus.
        if ($oldAuthorId != $author->id) {
            $oldAuthor = Author::find($oldAuthorId);
            if ($oldAuthor && $oldAuthor->books()->count() == 0) {
                $oldAuthor->delete();
            }
        }

        return redirect()->route('staff.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $authorId = $book->id_author; // Simpan ID penulis sebelum buku dihapus

        // Hapus Cover
        if ($book->cover && Storage::exists('public/' . $book->cover)) {
            Storage::delete('public/' . $book->cover);
        }

        // Hapus Buku
        $book->delete();

        // REVISI 2: HAPUS PENULIS JIKA BUKUNYA HABIS
        $author = Author::find($authorId);
        if ($author && $author->books()->count() == 0) {
            $author->delete();
        }

        return redirect()->route('staff.books.index')->with('success', 'Buku dihapus & Data Penulis dirapikan!');
    }
}