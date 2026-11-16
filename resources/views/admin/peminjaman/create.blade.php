@extends('layouts.admin')
@section('title', 'Catat Peminjaman')
@section('header', 'Catat Peminjaman')

@section('content')
<form action="{{ route('admin.peminjaman.store') }}" method="POST"
    class="bg-white rounded-xl shadow-sm p-8 max-w-3xl">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Barang *</label>
            <select name="inventaris_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih Barang --</option>
                @foreach($inventaris as $i)
                    <option value="{{ $i->id }}" {{ old('inventaris_id') == $i->id ? 'selected' : '' }}>
                        {{ $i->kode_barang }} - {{ $i->nama_barang }} (Stok: {{ $i->jumlah_tersedia }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peminjam *</label>
            <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No HP *</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pinjam *</label>
            <input type="number" name="jumlah_pinjam" value="{{ old('jumlah_pinjam', 1) }}" min="1" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pinjam *</label>
            <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Rencana Kembali *</label>
            <input type="date" name="tanggal_kembali_rencana" value="{{ old('tanggal_kembali_rencana') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('keterangan') }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
        <a href="{{ route('admin.peminjaman.index') }}"
        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
