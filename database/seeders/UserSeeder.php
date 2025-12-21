<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Staff Perpustakaan',
            'email' => 'staff@mail.com',
            'password' => Hash::make('staff123'),
            'role' => 'staff'
        ]);

        User::create([
            'name' => 'Member Setia',
            'email' => 'member@mail.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);
    }
}
