@extends('layouts.admin')
@section('title', 'Peminjaman')
@section('header', 'Peminjaman Barang')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.peminjaman.create') }}"
       class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">➕ Catat Peminjaman</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Barang</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Peminjam</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Pinjam</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($peminjamans as $p)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $p->inventaris->nama_barang ?? '-' }}</div>
                    <div class="text-xs text-gray-500 font-mono">{{ $p->inventaris->kode_barang ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $p->nama_peminjam }}</div>
                    <div class="text-xs text-gray-500">{{ $p->no_hp }}</div>
                </td>
                <td class="px-6 py-4 text-sm">{{ $p->jumlah_pinjam }}</td>
                <td class="px-6 py-4 text-sm">{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = ['dipinjam' => 'bg-yellow-100 text-yellow-700', 'dikembalikan' => 'bg-green-100 text-green-700', 'terlambat' => 'bg-red-100 text-red-700'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $colors[$p->status] }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($p->status === 'dipinjam')
                        <form action="{{ route('admin.peminjaman.kembalikan', $p) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1 text-sm bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100">
                                Kembalikan
                            </button>
                        </form>
                    @else
                        <span class="text-xs text-gray-400">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada peminjaman</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">{{ $peminjamans->links() }}</div>
</div>
@endsection
