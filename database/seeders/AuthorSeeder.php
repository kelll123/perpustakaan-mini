<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Tere Liye',
            'Dewi Lestari',
            'J.K. Rowling',
            'Andrea Hirata'
        ];

        foreach ($data as $penulis) {
            Author::create(['nama_author' => $penulis]);
        }
    }
}
