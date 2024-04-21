<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UlasanController extends Controller
{
    public function create($bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = User::all();
        $books = Book::all();
        $ulasans = Ulasan::all();
        return view('ulasan.add', compact('ulasans', 'books', 'user', 'bookId'));
    }

    public function store(Request $request, $bookId)
    {
    $request->validate([
        'buku_id' => 'required|exists:books,id',
        'ulasan' => 'required|string',
        'rating' => 'required|integer|min:1|max:5', // corrected the max value to '5'
    ]);

    $ulasan = new Ulasan([
        'user_id' => auth()->id(),
        'buku_id' => $bookId,
        'ulasan' => $request->ulasan,
        'rating' => $request->rating,
    ]);
    
    $ulasan->save(); // Save the review to the database

    return redirect('/books')->with('success', 'Ulasan berhasil ditambahkan.');
    }
    public function show($bookId)
    {
    
    $books = Book::all();
    $book = Book::findOrFail($bookId);
    $ulasans = Ulasan::where('buku_id', $bookId)->get();
    return view('ulasan.index', compact('book', 'ulasans', 'books'));
    dd($ulasans);
    }
}