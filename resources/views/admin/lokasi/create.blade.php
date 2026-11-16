@extends('layouts.admin')
@section('title', 'Tambah Lokasi')
@section('header', 'Tambah Lokasi')

@section('content')
<form action="{{ route('admin.lokasi.store') }}" method="POST"
    class="bg-white rounded-xl shadow-sm p-8 max-w-2xl">
    @csrf
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lokasi *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('keterangan') }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
        <a href="{{ route('admin.lokasi.index') }}"
        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
