<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendanaanSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'nis',
        'kelas',
        'jenis_pendanaan',
        'tanggal',
        'total_dana',
        'keterangan',
    ];

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanDanaSiswa::class, 'pendanaan_id');
    }
    
}
