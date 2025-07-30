<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pendanaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('barang');
            $table->string('kode_barang')->nullable(); // untuk pencarian
            $table->integer('jumlah')->default(1);
            $table->integer('harga')->default(0);
            $table->date('tanggal_pemberian');
            $table->string('keterangan')->nullable(); // bisa berisi status/penjelasan
            $table->string('foto')->nullable(); // bukti pembelian
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendanaans');
    }
};
