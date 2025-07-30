<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaBos extends Model
{
    use HasFactory;

    protected $table = 'dana_bos';

    protected $fillable = [
        'tanggal_masuk',
        'sumber',
        'foto',
    ];
}
