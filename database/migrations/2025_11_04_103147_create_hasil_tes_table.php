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
        Schema::create('hasil_tes', function (Blueprint $table) {
            $table->id(); // ERD: id_hasil (PK)

            // ERD: id_kuis (FK)
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');

            // ERD: id_member (FK)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // ERD: id_trans (FK) -> ke tabel 'pembayarans'
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->onDelete('cascade');

            $table->integer('skor');
            $table->date('tanggal');
            $table->string('desc')->nullable(); // deskripsi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_tes');
    }
};
