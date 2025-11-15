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
        Schema::create('materis', function (Blueprint $table) {
            $table->id(); // ERD: id_materi (PK)

            // ERD: id_course (FK)
            $table->foreignId('kursus_id')->constrained('kursuses')->onDelete('cascade');

            $table->string('judul');
            $table->string('tipe'); // "Video" atau "Teks"
            $table->string('url_video')->nullable();
            $table->text('teks_teori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
