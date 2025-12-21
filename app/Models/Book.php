<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books'; // Koneksi ke tabel books

    protected $fillable = [
        'title',        // Ganti 'judul' jadi 'title'
        'id_author',    // Ganti 'penulis' jadi relasi 'id_author'
        'id_category',  // Ganti 'kategori_id' jadi 'id_category'
        'stock',        // (Pastikan kolom ini ada di database)
        'deskripsi',  // atau 'deskripsi' sesuai tabel
        'cover',
        'tahun_terbit', // sesuai tabel
        'status'        // (Pastikan kolom ini ada di database)
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    // Relasi ke Author
    public function author()
    {
        return $this->belongsTo(Author::class, 'id_author');
    }
}