<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasanbuku extends Model
{
    protected $fillable = [

        'user_id',
        'buku_id',
        'ulasan',
        'rating',
    ];
}