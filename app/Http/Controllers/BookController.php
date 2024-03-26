<?php

namespace App\Http\Controllers;


use App\Models\Book;
use Illuminate\Http\Request;



class BookController extends Controller
{
   
    public function dashboard()
    {
        return view('dashboard');
    }

    public function books()
    {
        return view('books');
    }
    public function list()
    {
        return view('admin.list');
    }

    













































































    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}