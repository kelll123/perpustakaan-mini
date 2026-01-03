<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books'; 

    protected $fillable = [
        'title',       
        'id_author',   
        'id_category',  
        'stock',       
        'deskripsi',  
        'cover',
        'tahun_terbit', 
        'status'        
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

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
