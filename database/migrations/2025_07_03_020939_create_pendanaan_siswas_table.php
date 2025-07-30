<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendanaanSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('pendanaan_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nis')->unique();
            $table->string('kelas');
            $table->string('jenis_pendanaan');
            $table->date('tanggal');
            $table->integer('total_dana')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendanaan_siswas');
    }
}
