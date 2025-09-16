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
        Schema::table('students', function (Blueprint $table) {
            // Tambahkan kolom 'nim' setelah 'student_id'
            // NIM harus unik untuk setiap mahasiswa
            $table->string('nim', 20)->unique()->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Hapus kolom 'nim' jika migrasi di-rollback
            $table->dropColumn('nim');
        });
    }
};