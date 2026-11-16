@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('header', 'Tambah Kategori')

@section('content')
<form action="{{ route('admin.kategori.store') }}" method="POST"
    class="bg-white rounded-xl shadow-sm p-8 max-w-2xl">
    @csrf
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('deskripsi') }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
        <a href="{{ route('admin.kategori.index') }}"
        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
