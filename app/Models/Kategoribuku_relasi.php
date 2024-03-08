<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribuku_relasi extends Model
{
    protected $fillable = [

        'buku_id',
        'kategori_id',
    ];
}