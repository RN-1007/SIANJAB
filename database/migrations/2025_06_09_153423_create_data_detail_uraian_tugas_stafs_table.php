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
        Schema::create('data_detail_uraian_tugas_stafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_uraian_tugas_tusi')->constrained('uraian_tugas_dan_tusis')->onDelete('cascade');
            $table->string('uraian_tugas_staf');
            $table->string('abk_ideal');
            $table->string('abk_berlebih');
            $table->string('kategori_jabatan');
            $table->string('data_pendukung_sebelumnya')->nullable();
            $table->string('data_pendukung')->nullable();
            $table->enum('type_data_pendukung_sebelumnya', ['link', 'file'])->nullable();
            $table->enum('type_data_pendukung', ['link', 'file'])->nullable();
            $table->enum('status', ['belum', 'sudah'])->default('belum');
            $table->string('catatan_mahasiswa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uraian_tugas_stafs');
    }
};
