<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kolom Primary Key (nama default 'id')
            $table->string('full_name', 100);
            $table->string('username', 50)->unique();
            $table->string('password'); // Akan menyimpan password yang di-hash
            $table->enum('role', ['Admin', 'Mahasiswa'])->default('Mahasiswa');
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
