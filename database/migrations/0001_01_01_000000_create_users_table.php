<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ERD pakai 'username', tapi Breeze pakai 'name'. Jadi pakai 'name' sebagai username.
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Kolom TAMBAHAN dari ERD 'Member'
            $table->string('level')->default('Basic');
            $table->integer('progress')->default(0);

            // Kolom TAMBAHAN untuk 'Admin' (Role-Based Access)
            // 0 = Member, 1 = Admin
            $table->tinyInteger('role')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
