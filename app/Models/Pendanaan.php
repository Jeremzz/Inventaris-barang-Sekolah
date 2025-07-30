<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'kelas',
        'barang',
        'kode_barang',
        'jumlah',
        'harga',
        'tanggal_pemberian',
        'keterangan',
        'foto',
    ];
}
