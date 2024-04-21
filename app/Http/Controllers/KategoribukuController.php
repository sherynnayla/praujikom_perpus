<?php

namespace App\Http\Controllers;

use App\Models\Kategoribuku;
use Illuminate\Http\Request;

class KategoribukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Kategoribuku::all();
        return view('category', compact('categories'));
    }

    public function add()
    {
        return view('/add');
    } 

    public function addCategory (Request $request)
    {

        $request->validate([
           'nama_kategori'=> 'required',
        ]);

        Kategoribuku::create([
           'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect('/category')->with('success', 'Berhasil membuat buku');
    }

     public function edit($id)
    {
       //menampilkan form edit data
       $kategoribuku = Kategoribuku::where('id', $id)->first();
       //lalu tampilkan halaman 
       return view('edit', compact('kategoribuku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
          
            
        ]);

            Kategoribuku::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            
        ]);  

        return redirect('/category')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        
        Kategoribuku::where('id', '=', $id)->delete();
        return redirect('/category')->with('successDelete', 'Berhasil Menghapus Kategori!');
    }
    
}