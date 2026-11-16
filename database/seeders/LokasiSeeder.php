<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Ruang Utama', 'keterangan' => 'Ruang sholat utama'],
            ['nama' => 'Gudang', 'keterangan' => 'Penyimpanan barang'],
            ['nama' => 'Ruang Wudhu', 'keterangan' => 'Area wudhu'],
            ['nama' => 'Serambi', 'keterangan' => 'Area teras masjid'],
            ['nama' => 'Ruang Kantor', 'keterangan' => 'Ruang administrasi'],
        ];

        foreach ($data as $item) {
            Lokasi::create($item);
        }
    }
}
