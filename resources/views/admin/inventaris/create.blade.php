@extends('layouts.admin')
@section('title', 'Tambah Barang')
@section('header', 'Tambah Barang Inventaris')

@section('content')
<form action="{{ route('admin.inventaris.store') }}" method="POST" enctype="multipart/form-data"
    class="bg-white rounded-xl shadow-sm p-8 max-w-3xl">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang *</label>
            <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang *</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
            <select name="kategori_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
            <select name="lokasi_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih --</option>
                @foreach($lokasis as $l)
                    <option value="{{ $l->id }}" {{ old('lokasi_id') == $l->id ? 'selected' : '' }}>{{ $l->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Total *</label>
            <input type="number" name="jumlah_total" value="{{ old('jumlah_total', 1) }}" min="1" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi *</label>
            <select name="kondisi" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Perolehan</label>
            <input type="date" name="tanggal_perolehan" value="{{ old('tanggal_perolehan') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Perolehan</label>
            <input type="number" name="harga_perolehan" value="{{ old('harga_perolehan') }}" step="0.01"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sumber</label>
            <input type="text" name="sumber" value="{{ old('sumber') }}" placeholder="Donasi / Beli / Wakaf"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
            <input type="file" name="foto" accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('keterangan') }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-8">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
            Simpan
        </button>
        <a href="{{ route('admin.inventaris.index') }}"
        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
