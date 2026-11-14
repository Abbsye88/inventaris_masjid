<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKondisi extends Model
{
    protected $fillable = [
        'inventaris_id', 'kondisi_lama', 'kondisi_baru', 'catatan', 'user_id',
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
