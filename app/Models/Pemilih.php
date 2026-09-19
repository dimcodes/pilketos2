<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;

    protected $table = 'pemilihs';

    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'tanggal_lahir',
        'sudah_memilih',
    ];

    protected $casts = [
        'sudah_memilih' => 'boolean',
    ];
}