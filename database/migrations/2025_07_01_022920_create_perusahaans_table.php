<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perusahaans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('dudi_id'); // foreign key ke dudi
        $table->string('nama_barang');
        $table->date('tanggal_masuk');
        $table->string('foto')->nullable();
        $table->timestamps();

        $table->foreign('dudi_id')->references('id')->on('dudis')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
