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
        // Ini adalah tabel 'registrasi_kursus' dari ERD
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id(); // ERD: id_trans (PK)

            // ERD: id_member (FK) -> ke tabel 'users'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // ERD: id_course (FK) -> ke tabel 'kursus'
            $table->foreignId('kursus_id')->constrained('kursuses')->onDelete('cascade');

            // ERD: id_admin (FK) -> untuk verifikasi
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamp('tgl_trans')->useCurrent();
            $table->string('metode_bayar');
            $table->integer('total_byr');
            $table->string('bukti_byr')->nullable(); // Path ke file bukti
            $table->string('status')->default('Pending'); // Kolom tambahan yang berguna

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
