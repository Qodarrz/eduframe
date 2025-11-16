@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Foto</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Judul Foto</label>
            <input type="text" name="judul" value="{{ $foto->judul }}" class="border p-2 rounded w-full" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id" class="border p-2 rounded w-full">
                <option value="">-- Pilih Kategori (Opsional) --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $foto->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->icon ?? '📁' }} {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="border p-2 rounded w-full" placeholder="Ceritakan tentang foto ini...">{{ $foto->deskripsi }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Foto Sekarang</label>
            <img src="{{ $foto->path }}" alt="{{ $foto->judul }}" class="w-40 h-40 object-cover rounded mb-3">
        </div>

        <div>
            <label class="block mb-1 font-medium">Ganti Foto (opsional)</label>
            <input type="file" name="path" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ $foto->is_featured ? 'checked' : '' }}
                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <div>
                    <span class="font-medium">⭐ Jadikan Foto Unggulan</span>
                    <p class="text-xs text-gray-500">Foto unggulan akan ditampilkan di homepage</p>
                </div>
            </label>
        </div>

        <div class="flex gap-3">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('foto.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
        </div>
    </form>
</div>
@endsection
