<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $guarded = []; // Agar semua kolom bisa diisi

    // Satu peminjaman milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu peminjaman berisi satu buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
