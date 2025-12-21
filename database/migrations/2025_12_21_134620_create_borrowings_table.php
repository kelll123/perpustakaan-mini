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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            // Siapa yang meminjam (Relasi ke tabel users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Buku apa yang dipinjam (Relasi ke tabel books)
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');

            // Tanggal-tanggal penting
            $table->date('borrow_date'); // Tanggal pinjam
            $table->date('return_date'); // Tanggal harus kembali
            $table->date('actual_return_date')->nullable(); // Tanggal asli dikembalikan (diisi saat buku balik)

            // Status peminjaman
            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
