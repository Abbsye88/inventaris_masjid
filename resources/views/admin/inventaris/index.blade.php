@extends('layouts.admin')
@section('title', 'Inventaris')
@section('header', 'Data Inventaris')

@section('content')
<div class="flex justify-between items-center mb-6">
    <form method="GET" class="flex gap-3 flex-1 max-w-2xl">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari barang..."
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
        <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
        <button class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">Filter</button>
    </form>
    <a href="{{ route('admin.inventaris.create') }}"
    class="ml-4 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 flex items-center gap-2">
        ➕ Tambah Barang
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Foto</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Lokasi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kondisi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Stok</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($inventaris as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">📦</div>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm font-mono">{{ $item->kode_barang }}</td>
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-800">{{ $item->nama_barang }}</div>
                    <div class="text-xs text-gray-500">{{ $item->kategori->nama ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 text-sm">{{ $item->lokasi->nama ?? '-' }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = ['baik' => 'bg-green-100 text-green-700', 'rusak_ringan' => 'bg-yellow-100 text-yellow-700', 'rusak_berat' => 'bg-red-100 text-red-700'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $colors[$item->kondisi] }}">
                        {{ ucwords(str_replace('_', ' ', $item->kondisi)) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $item->jumlah_tersedia }} / {{ $item->jumlah_total }}</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.inventaris.edit', $item) }}"
                        class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">Edit</a>
                        <form action="{{ route('admin.inventaris.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus barang ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                    Belum ada data inventaris. <a href="{{ route('admin.inventaris.create') }}" class="text-emerald-600">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">{{ $inventaris->links() }}</div>
</div>
@endsection
