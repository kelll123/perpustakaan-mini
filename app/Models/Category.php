<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    // Cek di database kolomnya 'name' atau 'nama_kategori'
    protected $fillable = ['nama_kategori']; 

    public function books() { return $this->hasMany(Book::class, 'id_category'); }
}

