<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaDak extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_masuk',
        'sumber',
        'foto'
    ];
}
