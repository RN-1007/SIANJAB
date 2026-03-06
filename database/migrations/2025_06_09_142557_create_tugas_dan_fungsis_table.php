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
        Schema::create('tugas_dan_fungsis', function (Blueprint $table) {
            $table->id();
            $table->string('tusi');
            $table->integer('code_tusi')->unique();
            $table->string('nama_jabatan_permempan_45')->nullable();
            $table->string('nama_jabatan_permempan_41')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_dan_fungsis');
    }
};
