<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Kategoribuku;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;




class BookController extends Controller
{
    public function books()
    {
        
        $books = Book::all();
        $categories = Kategoribuku::all();

        return view('books', compact('books', 'categories'));
    }

    public function add()
    {
        $categories = Kategoribuku::all();
        return view('addBook', compact('categories'));
       
    }

    public function addBook(Request $request): RedirectResponse 
    {
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
    ]);

    $gambar = $request->file('gambar');
    $imageName = time().'.'.$gambar->extension();
    $gambar->move(public_path('uploads'), $imageName);

    $books = Book::create([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'gambar' => $imageName,
    ]);

    $books->categories()->sync($request->nama_kategori);


    return redirect('books')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        $categories = Kategoribuku::all();
        return view ('editBook', compact('book', 'categories'));
    }


    public function update(Request $request, $id)
    {
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $book = Book::findOrFail($id);

    $data = [
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
    ];

    // Perbarui gambar jika ada yang diunggah
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $imageName = time() . '.' . $gambar->extension();
        $gambar->move(public_path('uploads'), $imageName);
        $data['gambar'] = $imageName;
    }

    $book->update($data);

    // Sinkronkan kategori buku yang dipilih
    $book->categories()->sync($request->nama_kategori);

    return redirect('books')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Book::where('id', '=', $id)->delete();
        return redirect('/books')->with('successDelete', 'Berhasil Menghapus User!');
        
    }


}