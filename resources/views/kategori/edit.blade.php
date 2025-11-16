@extends('layouts.app')

@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Perbarui informasi kategori')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                <p class="font-bold mb-2">Error:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori *</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Kegiatan Sekolah">
                <p class="text-xs text-gray-500 mt-1">Slug saat ini: <strong>{{ $kategori->slug }}</strong></p>
            </div>

            <!-- Icon -->
            <div class="mb-6">
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">Icon (Emoji)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $kategori->icon) }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: 📚 atau 🎓">
                <p class="text-xs text-gray-500 mt-1">Gunakan emoji untuk mempercantik kategori</p>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Jelaskan kategori ini...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            <!-- Info -->
            <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                <p class="text-sm text-blue-700">
                    <strong>Info:</strong> Kategori ini memiliki <strong>{{ $kategori->fotos_count ?? 0 }}</strong> foto
                </p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button type="submit" 
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    Update Kategori
                </button>
                <a href="{{ route('kategori.index') }}" 
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
