<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategoribuku;
use Illuminate\Http\Request;
use App\Models\Koleksipribadi;

class KoleksipribadiController extends Controller
{
    public function koleksi()
    {
        $books = Book::all();
        $categories = Kategoribuku::all();
        $koleksi = Koleksipribadi::where('user_id', auth()->id())->with('books')->get();
        return view('koleksi', compact('books', 'koleksi', 'categories'));
    }
    

    public function tambah(Book $book)
    {
        $user_id = auth()->id();
    
        // Cek apakah buku sudah ada dalam koleksi pribadi pengguna
        $existingKoleksi = Koleksipribadi::where('user_id', $user_id)
            ->where('buku_id', $book->id)
            ->first();
    
        if ($existingKoleksi) {
            // Buku sudah ada dalam koleksi pribadi, tidak perlu menambahkannya lagi
            return redirect()->back()->with('error', 'Buku sudah ada dalam koleksi pribadi Anda.');
        }
    
        // Jika buku belum ada dalam koleksi pribadi, tambahkan ke koleksi pribadi
        $koleksi = Koleksipribadi::create([
            'user_id' => $user_id,
            'buku_id' => $book->id,
        ]);
    
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi pribadi.');
    }
    
}