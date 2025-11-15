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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel 'kuis'
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');

            // Ini adalah kolom 'pertanyaan' dan 'jawaban_bnr' dari ERD 'kuis'
            $table->text('pertanyaan');
            $table->string('jawaban_bnr'); // misal: "A"

            // Opsi jawaban (desain yang lebih baik)
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
