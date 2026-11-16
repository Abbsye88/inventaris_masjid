@extends('layouts.admin')
@section('title', 'Kategori')
@section('header', 'Kategori Barang')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.kategori.create') }}"
       class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">➕ Tambah Kategori</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah Barang</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kategoris as $k)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $k->nama }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $k->deskripsi ?? '-' }}</td>
                <td class="px-6 py-4 text-sm">{{ $k->inventaris_count }} barang</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kategori.edit', $k) }}"
                           class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus? Barang dengan kategori ini juga akan terhapus.')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">Belum ada kategori</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">{{ $kategoris->links() }}</div>
</div>
@endsection
