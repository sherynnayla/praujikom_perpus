<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'nama_lengkap' => 'admin',
            'password' => bcrypt('1234'),
            'alamat' => 'jalan mawar',
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'nama_lengkap' => 'petugas',
            'password' => bcrypt('1234'),
            'alamat' => 'jalan mawar',
            'role' => 'petugas'
        ]);
    }
}