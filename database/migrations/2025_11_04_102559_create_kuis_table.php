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
        // Struktur ini lebih baik dari ERD (Kuis punya banyak Soal)
        Schema::create('kuis', function (Blueprint $table) {
            $table->id(); // ERD: id_kuis (PK)

            // ERD: id_materi (FK)
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');

            $table->string('judul_kuis'); // Kolom tambahan yang berguna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
