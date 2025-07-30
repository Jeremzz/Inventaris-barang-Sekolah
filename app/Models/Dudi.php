<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    protected $fillable = ['nama_perusahaan'];

    public function perusahaanBarangs()
    {
        return $this->hasMany(Perusahaan::class, 'dudi_id');
    }
}
