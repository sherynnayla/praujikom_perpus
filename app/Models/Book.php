<?php

namespace App\Models;

use App\Models\Ulasan;
use App\Models\Peminjaman;
use App\Models\Kategoribuku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'gambar',

        
    ];

   

    public function categories(): BelongsToMany
    {
    return $this->belongsToMany(Kategoribuku::class, 'kategoribuku_relasis', 'buku_id', 'kategori_id');
    }

public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function koleksi()
    {
        return $this->belongsToMany(Koleksipribadi::class);
    }

    public function ulasans()
    {
        return $this->belongsToMany(Ulasan::class);
    }

}