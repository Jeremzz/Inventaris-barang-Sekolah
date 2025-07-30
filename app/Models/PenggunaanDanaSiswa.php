<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanDanaSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendanaan_id',
        'nama_barang',
        'kode_barang',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'bukti_foto',
    ];

    public function pendanaan()
    {
        return $this->belongsTo(PendanaanSiswa::class, 'pendanaan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_harga = $model->jumlah * $model->harga_satuan;
        });
    }

}
