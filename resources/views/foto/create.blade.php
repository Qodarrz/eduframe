@extends('layouts.app')

@section('page-title', 'Upload Foto')
@section('page-subtitle', 'Tambahkan foto baru ke galeri')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                <p class="font-bold mb-2">Error Upload:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Upload Image -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto *</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-500 transition">
                    <input type="file" name="path" id="path" accept="image/*" required class="hidden" onchange="previewImage(event)">
                    <label for="path" class="cursor-pointer">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="preview-image" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-gray-600 font-semibold mb-1">Klik untuk upload foto</p>
                            <p class="text-sm text-gray-500">JPG, PNG, WEBP (Max 15MB)</p>
                        </div>
                    </label>
                </div>
                @error('path')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Foto *</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Upacara Bendera 17 Agustus">
                @error('judul')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="kategori_id" id="kategori_id" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Pilih Kategori (Opsional) --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->icon ?? '📁' }} {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Ceritakan tentang foto ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alt Text -->
            <div class="mb-6">
                <label for="alt_text" class="block text-sm font-semibold text-gray-700 mb-2">Alt Text (SEO)</label>
                <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Deskripsi singkat untuk SEO (opsional)">
                <p class="text-xs text-gray-500 mt-1">Jika kosong, akan menggunakan judul foto</p>
                @error('alt_text')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Featured -->
            <div class="mb-8">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <div>
                        <span class="text-sm font-semibold text-gray-700">⭐ Jadikan Foto Unggulan</span>
                        <p class="text-xs text-gray-500">Foto unggulan akan ditampilkan di homepage</p>
                    </div>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button type="submit" 
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    Upload Foto
                </button>
                <a href="{{ route('foto.index') }}" 
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
