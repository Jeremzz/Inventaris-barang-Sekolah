<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
    'jurusan_id',
    'nama_barang',
    'kode_seri',
    'tahun_pengadaan',
    'kondisi',
    'foto',
];

    public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

}
