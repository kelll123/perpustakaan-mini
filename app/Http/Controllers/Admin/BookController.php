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
    public function index(Request $request)
    {
        $categories = Category::all();
        $books = Book::with(['author', 'category'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('id_category', $request->category_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.buku.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.buku.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'nama_author'  => 'required|string|max:255',
            'id_category'  => 'required|exists:categories,id',
            'stock'        => 'required|integer|min:0',
            'tahun_terbit' => 'required|integer|min:1000|max:' . (date('Y') + 1), // Validasi tahun
            'deskripsi'    => 'nullable|string',
            'status'       => 'required|in:aktif,nonaktif',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $namaAuthor = Str::title(trim($request->nama_author));
        $author = Author::firstOrCreate(['nama_author' => $namaAuthor]);

        Book::create([
            'title'        => $request->title,
            'id_author'    => $author->id,
            'id_category'  => $request->id_category,
            'stock'        => $request->stock,
            'tahun_terbit' => $request->tahun_terbit, // Simpan tahun terbit
            'deskripsi'    => $request->deskripsi,
            'status'       => $request->status,
            'cover'        => $coverPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Book::with('author')->findOrFail($id);
        $categories = Category::all();
        return view('admin.buku.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'nama_author'  => 'required|string|max:255',
            'id_category'  => 'required|exists:categories,id',
            'stock'        => 'required|integer|min:0',
            'tahun_terbit' => 'required|integer|min:1000|max:' . (date('Y') + 1), // Validasi tahun
            'deskripsi'    => 'nullable|string',
            'status'       => 'required|in:aktif,nonaktif',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaAuthor = Str::title(trim($request->nama_author));
        $author = Author::firstOrCreate(['nama_author' => $namaAuthor]);

        $data = [
            'title'        => $request->title,
            'id_author'    => $author->id,
            'id_category'  => $request->id_category,
            'stock'        => $request->stock,
            'tahun_terbit' => $request->tahun_terbit, // Update tahun terbit
            'deskripsi'    => $request->deskripsi,
            'status'       => $request->status,
        ];

        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::exists('public/' . $book->cover)) {
                Storage::delete('public/' . $book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $oldAuthorId = $book->id_author;
        $book->update($data);

        if ($oldAuthorId != $author->id) {
            $oldAuthor = Author::find($oldAuthorId);
            if ($oldAuthor && $oldAuthor->books()->count() == 0) {
                $oldAuthor->delete();
            }
        }

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $authorId = $book->id_author;

        if ($book->cover && Storage::exists('public/' . $book->cover)) {
            Storage::delete('public/' . $book->cover);
        }

        $book->delete();

        $author = Author::find($authorId);
        if ($author && $author->books()->count() == 0) {
            $author->delete();
        }

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
