<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rincian_tugas_staf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_uraian_tugas_staf_id');
            $table->string('hasil_kerja');
            $table->string('satuan_hasil');
            $table->integer('target');
            $table->string('frekuensi');
            $table->integer('volume');
            $table->integer('waktu_penyelesaian');
            $table->timestamps();
            $table->foreign('detail_uraian_tugas_staf_id')->references('id')->on('data_detail_uraian_tugas_stafs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rincian_tugas_staf');
    }
};
