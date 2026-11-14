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
    Schema::create('riwayat_kondisis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');
        $table->enum('kondisi_lama', ['baik', 'rusak_ringan', 'rusak_berat']);
        $table->enum('kondisi_baru', ['baik', 'rusak_ringan', 'rusak_berat']);
        $table->text('catatan')->nullable();
        $table->foreignId('user_id')->constrained('users');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kondisis');
    }
};
