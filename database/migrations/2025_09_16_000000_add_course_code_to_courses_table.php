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
        Schema::table('courses', function (Blueprint $table) {
            // Menambahkan kolom 'course_code' setelah 'course_id'
            // Kode mata kuliah harus unik
            $table->string('course_code', 20)->unique()->after('course_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Hapus kolom 'course_code' jika migrasi di-rollback
            $table->dropColumn('course_code');
        });
    }
};