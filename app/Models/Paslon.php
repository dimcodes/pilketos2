<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    use HasFactory;

    protected $table = 'paslons';

    protected $fillable = [
        'no_urut',
        'nama_paslon',
        'suara',
    ];
}