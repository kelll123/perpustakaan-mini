<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::latest()->get();
        return view('admin.authors.index', compact('authors'));
    }

    public function create() {
        return view('admin.authors.create');
    }

    public function store(Request $request) {
        $request->validate(['nama_author' => 'required|string|max:255']);
        Author::create($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Penulis berhasil ditambah');
    }

    public function edit($id) {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, $id) {
        $request->validate(['nama_author' => 'required|string|max:255']);
        $author = Author::findOrFail($id);
        $author->update($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Penulis berhasil diupdate');
    }

    public function destroy($id) {
        Author::findOrFail($id)->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Penulis berhasil dihapus');
    }
}