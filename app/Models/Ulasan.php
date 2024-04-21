<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = [

        'user_id',
        'buku_id',
        'ulasan',
        'rating',
    ];
    public function books()
    {
        return $this->belongsTo(Book::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}