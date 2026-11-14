<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'inventaris_id', 'user_id', 'nama_peminjam', 'no_hp',
        'jumlah_pinjam', 'tanggal_pinjam', 'tanggal_kembali_rencana',
        'tanggal_kembali_aktual', 'status', 'keterangan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali_rencana' => 'date',
        'tanggal_kembali_aktual' => 'date',
    ];

    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
