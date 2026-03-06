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
        Schema::create('struktur_jabatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pd')->constrained('data_pds')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->enum('tipe_jabatan', [
                'Pimpinan Tinggi',
                'Nomenklatur Jabatan',
                'Kepala',
                'Sub Kepala',
                'Staf Ahli',
                'Jabatan Fungsional'
            ])->nullable();
            $table->integer('kelas_jabatan')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('struktur_jabatans')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_jabatans');
    }
};
