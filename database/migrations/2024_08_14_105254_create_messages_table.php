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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Kolom id otomatis ditambahkan
            $table->text('question'); // Kolom untuk pertanyaan
            $table->text('answer')->nullable(); // Kolom untuk jawaban, nullable jika tidak ada jawaban
            $table->timestamp('createdAt')->nullable(); // Kolom untuk waktu pembuatan, nullable jika belum diisi
            $table->timestamps(); // Kolom timestamps default Laravel untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
