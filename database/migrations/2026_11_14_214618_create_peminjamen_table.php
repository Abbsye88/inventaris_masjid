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
    Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users');
        $table->string('nama_peminjam');
        $table->string('no_hp');
        $table->integer('jumlah_pinjam');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali_rencana');
        $table->date('tanggal_kembali_aktual')->nullable();
        $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
