<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->integer('stok')->default(0);

            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // Relasi kategori
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
