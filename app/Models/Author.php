<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $fillable = ['nama_author'];

    // TAMBAHKAN INI: Relasi ke Buku
    public function books()
    {
        return $this->hasMany(Book::class, 'id_author');
    }
}