2<?php

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
            Schema::create('uraian_tugas_dan_tusis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_tusi')->constrained('tugas_dan_fungsis')->onDelete('cascade');
                $table->foreignId('id_uraian_tugas_staf')->constrained('data_uraian_tugas_stafs')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('uraian_tugas_dan_tusis');
        }
    };
