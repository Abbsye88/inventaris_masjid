@extends('layouts.admin')
@section('title', 'Edit Peminjaman')
@section('header', 'Edit Peminjaman')

@section('content')
<form action="{{ route('admin.peminjaman.update', $peminjaman) }}" method="POST"
    class="bg-white rounded-xl shadow-sm p-8 max-w-3xl">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peminjam *</label>
            <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No HP *</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $peminjaman->no_hp) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Rencana Kembali *</label>
            <input type="date" name="tanggal_kembali_rencana"
                value="{{ old('tanggal_kembali_rencana', $peminjaman->tanggal_kembali_rencana?->format('Y-m-d')) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('keterangan', $peminjaman->keterangan) }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Update</button>
        <a href="{{ route('admin.peminjaman.index') }}"
        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
