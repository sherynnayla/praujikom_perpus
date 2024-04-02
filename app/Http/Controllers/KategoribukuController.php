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
    public function show(Kategoribuku $kategoribuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

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

    /**
     * Update the specified resource in storage.
     */
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //parameter $id  mengambil data dari path dinamis {id}
        //cari data yang isian column id nya sama dengan $id yang dikirim ke path dinamis
        //kalau ada, ambil terus hapus datanya
        Kategoribuku::where('id', '=', $id)->delete();
        //kalau berhasil, nakal dibalikin ke halaman list todo dengan pemberitahuan
        return redirect('/category')->with('successDelete', 'Berhasil Menghapus Kategori!');
    }
    
}