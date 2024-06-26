<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Koleksipribadi extends Model
{
    protected $fillable = [
        'user_id',
        'buku_id',
    ];

    public function books()
    {
        return $this->belongsTo(Book::class, 'buku_id');
    }
}