<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // 1. TAMPILKAN DAFTAR STAFF
    public function index()
    {
        // Hanya ambil data yang role-nya 'staff'
        $staffMembers = User::where('role', 'staff')->latest()->paginate(10);
        return view('admin.staff.index', compact('staffMembers'));
    }

    // 2. FORM TAMBAH STAFF
    public function create()
    {
        return view('admin.staff.create');
    }

    // 3. SIMPAN STAFF BARU
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role'     => 'staff', // Paksa role menjadi 'staff'
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff baru berhasil ditambahkan!');
    }

    // 4. FORM EDIT STAFF
    public function edit($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    // 5. UPDATE DATA STAFF
    public function update(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Data staff diperbarui!');
    }

    // 6. HAPUS STAFF
    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Akun staff dihapus!');
    }
}
