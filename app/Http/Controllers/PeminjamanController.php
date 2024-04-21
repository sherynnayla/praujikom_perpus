<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class PeminjamanController extends Controller
{

    public function index()
    {
    $books = Book::all();
    $user = User::all();
    $userId = auth()->user()->id;

    if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas') {
        // Jika pengguna adalah admin atau petugas, ambil semua data peminjaman
        $peminjamen = Peminjaman::all();
    } else {
        // Jika bukan admin atau petugas, ambil hanya data peminjaman yang terkait dengan pengguna yang saat ini masuk
        $peminjamen = Peminjaman::where('user_id', $userId)->get();
    }

    return view('/peminjaman', compact('books', 'user', 'peminjamen'));
    }

    public function search(Request $request, Book $books)
    {

        if ($request->has('search')) {
            $peminjamen = Peminjaman::where('tanggal_peminjaman', 'LIKE', '%' . $request->search . '%')
            ->orWhere('status_peminjaman', 'LIKE', '%' . $request->search . '%')
            ->orWhere('tanggal_pengembalian', 'LIKE', '%' . $request->search . '%')
            ->get();
            if(count($peminjamen) == 0){
                $user = User::where('nama', 'LIKE', '%'. $request->search. '%')->first('id');
                if(!$user){
                    $books = Book::where('judul', 'LIKE', '%'. $request->search .'%')->first('id');
                        if($books){
                        $peminjamen = Peminjaman::where('buku_id', $books['id'])->get();
                    }
                }else{
                    $peminjamen = Peminjaman::where('user_id', $user['id'])->get();
            }
        }
    
        } else {
            $peminjamen = Peminjaman::all();
        }
        return view('peminjaman', compact('peminjamen'));
    }
    public function export()
    {
        
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');

    }

    public function store(Request $request)
    { 
        $request->validate([
            'buku_id' =>'required|exists:books,id',
        ]);

        if(auth()->check()) {
            Peminjaman::updateOrCreate([
                'user_id' => auth()->id(),
                'buku_id' => $request->buku_id,
                'tanggal_peminjaman' => now(), 
                'tanggal_pengembalian' => Carbon::now(), 
                'status_peminjaman' => 'Dipinjam',
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } 

        return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
    }

    public function selesai($id)
    {
        // Cari peminjaman berdasarkan ID
        $peminjamen = Peminjaman::findOrFail($id);

        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($peminjamen->status_peminjaman == 'Dipinjam') {
            // Ubah status peminjaman menjadi 'sudah dikembalikan'
            $peminjamen->status_peminjaman = 'Dikembalikan';

            // Isi tanggal pengembalian dengan tanggal saat ini
            // $peminjaman->tanggal_pengembalian = now();
            $peminjamen->tanggal_pengembalian = Carbon::now();


            // Simpan perubahan
            $peminjamen->save();

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }
    }
}