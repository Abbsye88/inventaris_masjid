@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-emerald-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Total Barang</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalBarang }}</p>
            </div>
            <div class="text-3xl">📦</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Barang Baik</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $barangBaik }}</p>
            </div>
            <div class="text-3xl">✅</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $dipinjam }}</p>
            </div>
            <div class="text-3xl">📤</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Perlu Perbaikan</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $rusak }}</p>
            </div>
            <div class="text-3xl">⚠️</div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-800">Barang Terbaru</h3>
        <a href="{{ route('admin.inventaris.index') }}" class="text-sm text-emerald-600 hover:underline">
            Lihat Semua →
        </a>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kondisi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Stok</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($barangTerbaru as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-mono">{{ $item->kode_barang }}</td>
                <td class="px-6 py-4 text-sm font-medium">{{ $item->nama_barang }}</td>
                <td class="px-6 py-4 text-sm">{{ $item->kategori->nama ?? '-' }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = ['baik' => 'bg-green-100 text-green-700', 'rusak_ringan' => 'bg-yellow-100 text-yellow-700', 'rusak_berat' => 'bg-red-100 text-red-700'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $colors[$item->kondisi] }}">
                        {{ ucwords(str_replace('_', ' ', $item->kondisi)) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $item->jumlah_tersedia }} / {{ $item->jumlah_total }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada data barang</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
