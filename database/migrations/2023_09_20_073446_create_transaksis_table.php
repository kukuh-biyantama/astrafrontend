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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_books');
            $table->unsignedBigInteger('id_users');
            $table->string('nama_pembeli');
            $table->string('alamat_pengiriman');
            $table->integer('total_buku');
            $table->decimal('biaya', 10, 2);
            $table->string('status')->default('0');
            $table->timestamps();
            $table->foreign('id_books')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
