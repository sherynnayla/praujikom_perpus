<?php

namespace App\Models;

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

}