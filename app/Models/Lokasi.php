<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = ['nama', 'keterangan'];

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }
}
