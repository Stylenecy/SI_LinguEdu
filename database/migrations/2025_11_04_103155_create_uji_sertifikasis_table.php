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
        // NOTE: Desain ERD ini (menyimpan 'pertanyaan' di sini) kurang ideal,
        // tapi  ngikut ERD sebagai patokan.
        Schema::create('uji_sertifikasis', function (Blueprint $table) {
            $table->id(); // ERD: kode_tes (PK)

            // ERD: id_member (FK)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // ERD: id_materi (FK). Agak aneh, mungkin harusnya ke 'kursus_id'?
            // Tapi tetep ngikut ERD.
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');

            // ERD: id_trans (FK)
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->onDelete('cascade');

            $table->text('pertanyaan');
            $table->string('jawaban_bnr');
            $table->string('jawaban_user')->nullable();
            $table->boolean('is_correct')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_sertifikasis');
    }
};
