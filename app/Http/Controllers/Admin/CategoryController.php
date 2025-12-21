<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. TAMPILKAN DAFTAR KATEGORI
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.kategori.index', compact('categories'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.kategori.create');
    }

    // 3. SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            // Validasi: Wajib isi & harus unik di tabel categories
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.kategori.edit', compact('category'));
    }

    // 5. UPDATE DATA
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            // Validasi unik, tapi abaikan ID kategori yang sedang diedit ini
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $category->id,
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Opsional: Cek apakah kategori masih dipakai buku sebelum dihapus
        if ($category->books()->exists()) {
            return back()->with('error', 'Gagal hapus! Kategori ini masih digunakan oleh beberapa buku.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
