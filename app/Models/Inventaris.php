<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori_id', 'lokasi_id',
        'jumlah_total', 'jumlah_tersedia', 'kondisi',
        'tanggal_perolehan', 'harga_perolehan', 'sumber',
        'keterangan', 'foto',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
        'harga_perolehan' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function riwayatKondisi()
    {
        return $this->hasMany(RiwayatKondisi::class);
    }
}