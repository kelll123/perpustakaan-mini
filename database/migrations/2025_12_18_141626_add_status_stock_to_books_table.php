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
    Schema::table('books', function (Blueprint $table) {
        // Menambahkan kolom yang hilang
        $table->integer('stock')->default(0); // sesuaikan letak
        $table->string('isbn')->nullable()->unique()->after('id');
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('stock');
    });
}

public function down(): void
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropColumn(['stock', 'isbn', 'status']);
    });
}
};