<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Inventaris::count();
        $barangBaik = Inventaris::where('kondisi', 'baik')->count();
        $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $rusak = Inventaris::whereIn('kondisi', ['rusak_ringan', 'rusak_berat'])->count();
        $barangTerbaru = Inventaris::with(['kategori', 'lokasi'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBarang', 'barangBaik', 'dipinjam', 'rusak', 'barangTerbaru'
        ));
    }
}
