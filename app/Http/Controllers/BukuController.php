<?php


class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('staff.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('staff.buku.create');
    }

    public function store(Request $request)
    {
        Buku::create($request->all());
        return redirect()->route('staff.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('staff.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect()->route('staff.buku.index')->with('success', 'Buku berhasil diperbarui');
    }
}
