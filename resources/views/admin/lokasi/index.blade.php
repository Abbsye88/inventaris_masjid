@extends('layouts.admin')
@section('title', 'Lokasi')
@section('header', 'Lokasi Barang')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.lokasi.create') }}"
       class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">➕ Tambah Lokasi</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah Barang</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($lokasis as $l)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $l->nama }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $l->keterangan ?? '-' }}</td>
                <td class="px-6 py-4 text-sm">{{ $l->inventaris_count }} barang</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.lokasi.edit', $l) }}"
                           class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">Edit</a>
                        <form action="{{ route('admin.lokasi.destroy', $l) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">Belum ada lokasi</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">{{ $lokasis->links() }}</div>
</div>
@endsection