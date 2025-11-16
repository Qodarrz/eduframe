@extends('layouts.app')

@section('page-title', 'Edit Informasi')
@section('page-subtitle', 'Perbarui informasi atau pengumuman')

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

        <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Upload Gambar -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar</label>
                
                @if($informasi->gambar)
                    <div class="mb-4">
                        <img src="{{ $informasi->gambar }}" alt="Current" class="max-h-48 rounded-lg">
                        <p class="text-sm text-gray-500 mt-2">Gambar saat ini</p>
                    </div>
                @endif
                
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-500 transition">
                    <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(event)">
                    <label for="gambar" class="cursor-pointer">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="preview-image" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-gray-600 font-semibold mb-1">Klik untuk upload gambar baru</p>
                            <p class="text-sm text-gray-500">JPG, PNG, WEBP (Max 15MB)</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Informasi *</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $informasi->judul) }}" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Pengumuman Libur Semester">
            </div>

            <!-- Tipe -->
            <div class="mb-6">
                <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Informasi *</label>
                <select name="tipe" id="tipe" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="visi" {{ old('tipe', $informasi->tipe) == 'visi' ? 'selected' : '' }}>🎯 Visi</option>
                    <option value="misi" {{ old('tipe', $informasi->tipe) == 'misi' ? 'selected' : '' }}>🚀 Misi</option>
                    <option value="sejarah" {{ old('tipe', $informasi->tipe) == 'sejarah' ? 'selected' : '' }}>📜 Sejarah</option>
                    <option value="jurusan" {{ old('tipe', $informasi->tipe) == 'jurusan' ? 'selected' : '' }}>🎓 Jurusan</option>
                    <option value="umum" {{ old('tipe', $informasi->tipe) == 'umum' ? 'selected' : '' }}>📢 Umum</option>
                </select>
            </div>

            <!-- Urutan -->
            <div class="mb-6">
                <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampilan</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $informasi->urutan) }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="0">
                <p class="text-xs text-gray-500 mt-1">Semakin kecil angka, semakin atas posisinya</p>
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="konten" class="block text-sm font-semibold text-gray-700 mb-2">Konten *</label>
                <textarea name="konten" id="konten" rows="10" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis konten informasi lengkap di sini...">{{ old('konten', $informasi->konten) }}</textarea>
            </div>

            <!-- Is Published -->
            <div class="mb-8">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $informasi->is_published) ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <div>
                        <span class="text-sm font-semibold text-gray-700">Publikasikan Informasi</span>
                        <p class="text-xs text-gray-500">Informasi akan tampil di halaman publik</p>
                    </div>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button type="submit" 
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    Update Informasi
                </button>
                <a href="{{ route('informasi.index') }}" 
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
