<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanDanaSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('penggunaan_dana_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendanaan_id')->constrained('pendanaan_siswas')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('kode_barang');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->string('bukti_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggunaan_dana_siswas');
    }
}
