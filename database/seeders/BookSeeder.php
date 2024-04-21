<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Kategoribuku;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Kategoribuku::create([
            'nama_kategori' => 'Horror',
        ]);

        Kategoribuku::create([
            'nama_kategori' => 'Romance',
        ]);

        Kategoribuku::create([
            'nama_kategori' => 'Sience',
        ]);

        
        
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

        User::create([
            'username' => 'sher',
            'email' => 'sher@gmail.com',
            'nama_lengkap' => 'sher',
            'password' => bcrypt('1234'),
            'alamat' => 'jalan mawar',
            'role' => 'peminjam'
        ]);

        
    }
}