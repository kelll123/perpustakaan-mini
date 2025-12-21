<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Novel',
            'Teknologi',
            'Pendidikan',
            'Sejarah'
        ];

        foreach ($data as $kategori) {
            Category::create(['nama_kategori' => $kategori]);
        }
    }
}
