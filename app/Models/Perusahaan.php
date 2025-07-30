<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = ['dudi_id', 'nama_barang', 'tanggal_masuk', 'foto'];

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
