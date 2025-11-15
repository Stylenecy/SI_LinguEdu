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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id(); // ERD: kode_sertif (PK)

            // ERD: id_course (FK)
            $table->foreignId('kursus_id')->constrained('kursuses')->onDelete('cascade');

            // ERD: id_trans (FK)
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->onDelete('cascade');

            // Tambahan: 'user_id' biar mudah nyari sertif per user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->date('tgl_lulus');
            $table->string('unique_code')->unique(); // Kode unik sertifikat

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
