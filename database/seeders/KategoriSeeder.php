<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Alat Ibadah', 'deskripsi' => 'Sajadah, mukena, Al-Quran'],
            ['nama' => 'Elektronik', 'deskripsi' => 'Sound system, mic, kipas'],
            ['nama' => 'Furniture', 'deskripsi' => 'Kursi, meja, lemari'],
            ['nama' => 'Kebersihan', 'deskripsi' => 'Sapu, pengki, tempat sampah'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Barang lain-lain'],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
