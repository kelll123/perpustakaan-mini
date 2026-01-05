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
        // Tambahkan pengecekan if di sini untuk menghindari error Duplicate Column
        if (!Schema::hasColumn('books', 'tahun_terbit')) {
            Schema::table('books', function (Blueprint $table) {
                $table->integer('tahun_terbit')->after('stock')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'tahun_terbit')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('tahun_terbit');
            });
        }
    }
};
