<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Bumi',
            'id_category' => 1,
            'id_author' => 1,
            'cover' => null,
            'deskripsi' => 'Novel fantasi dari Tere Liye.',
            'tahun_terbit' => 2014
        ]);

        Book::create([
            'title' => 'Harry Potter',
            'id_category' => 1,
            'id_author' => 3,
            'cover' => null,
            'deskripsi' => 'Novel petualangan penyihir.',
            'tahun_terbit' => 1997
        ]);
    }
}
