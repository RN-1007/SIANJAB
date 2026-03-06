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
        Schema::create('data_uraian_tugas_stafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('kelas_jabatan');
            $table->integer('jumlah_eksisting');
            $table->unsignedInteger('pns')->default(0);
            $table->unsignedInteger('non_pns')->default(0);
            $table->unsignedInteger('pppk')->default(0);
            $table->unsignedInteger('cpns')->default(0);
            $table->integer('pemenuhan_pegawai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_uraian_tugas_stafs');
    }
};
