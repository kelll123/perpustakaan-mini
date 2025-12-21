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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable()->unique();
            $table->string('title');
            // Relasi ke categories & authors
            $table->foreignId('id_category')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('id_author')->nullable()->constrained('authors')->nullOnDelete();
            $table->string('cover')->nullable();
            $table->text('deskripsi')->nullable();
            $table->year('tahun_terbit')->nullable();
            // Kolom tambahan (stock & status) langsung dimasukin sini
            $table->integer('stock')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
