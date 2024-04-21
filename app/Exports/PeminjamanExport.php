<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeminjamanExport implements FromView
{

    public function view(): View
        {
            $peminjamen = Peminjaman::all();
            $books = Book::all();
            $search = request('search');
            if ($search) {
                $peminjamen = Peminjaman::with('user', 'books')->where('tanggal_peminjaman', 'LIKE', '%' . $search . '%')
                    ->orWhere('status_peminjaman', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal_pengembalian', 'LIKE', '%' . $search . '%')
                    ->get();
                if(count($peminjamen) == 0){
                    $user = User::where('username', 'LIKE', '%'. $search. '%')->first('id');
                    if(!$user){
                        $books = Book::where('judul', 'LIKE', '%'. $search .'%')->first('id');
                        if($books){
                            $peminjamen = Peminjaman::with('user', 'books')->where('buku_id', $books['id'])->get();
                        }
                    }else{
                        $peminjamen = Peminjaman::with('user', 'books')->where('user_id', $user['id'])->get();
                    }
                }
    
                
                
            } else {
                $peminjamen = Peminjaman::with('user', 'books')->get();
            }
    
            return view('excel', ['peminjamen' => $peminjamen]);
        }
    
        }
    
    