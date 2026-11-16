@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')
<form action="{{ route('admin.kategori.update', $kategori) }}" method="POST"
      class="bg-white rounded-xl shadow-sm p-8 max-w-2xl">
    @csrf @method('PUT')
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>
    </div>
    <div class="flex gap-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Update</button>
        <a href="{{ route('admin.kategori.index') }}"
           class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
