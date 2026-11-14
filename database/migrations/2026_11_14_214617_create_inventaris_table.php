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
        Schema::create('inventaris', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang')->unique();
        $table->string('nama_barang');
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->foreignId('lokasi_id')->constrained('lokasis')->onDelete('cascade');
        $table->integer('jumlah_total')->default(1);
        $table->integer('jumlah_tersedia')->default(1);
        $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
        $table->date('tanggal_perolehan')->nullable();
        $table->decimal('harga_perolehan', 15, 2)->nullable();
        $table->string('sumber')->nullable();
        $table->text('keterangan')->nullable();
        $table->string('foto')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
