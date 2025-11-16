@extends('layouts.app')

@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Perbarui berita atau artikel')

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

        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Upload Gambar -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar</label>
                
                @if($berita->gambar)
                    <div class="mb-4">
                        <img src="{{ $berita->gambar) }}" alt="Current" class="max-h-48 rounded-lg">
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
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita *</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Prestasi Siswa di Lomba Nasional">
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Berita *</label>
                <select name="kategori" id="kategori" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Jenis Berita</option>
                    <option value="kehilangan" {{ old('kategori', $berita->kategori) == 'kehilangan' ? 'selected' : '' }}>Kehilangan</option>
                    <option value="ditemukan" {{ old('kategori', $berita->kategori) == 'ditemukan' ? 'selected' : '' }}>Ditemukan</option>
                    <option value="prestasi" {{ old('kategori', $berita->kategori) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                    <option value="prestasi sekolah" {{ old('kategori', $berita->kategori) == 'prestasi sekolah' ? 'selected' : '' }}>Prestasi Sekolah</option>
                    <option value="agenda" {{ old('kategori', $berita->kategori) == 'agenda' ? 'selected' : '' }}>Agenda</option>
                </select>
            </div>

            <!-- Lokasi Terakhir (untuk kategori kehilangan) -->
            <div id="lokasiTerakhirField" class="mb-6" style="display: none;">
                <label for="lokasi_terakhir" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Terakhir *</label>
                <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" value="{{ old('lokasi_terakhir', $berita->lokasi_terakhir) }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Ruang Kelas XII-IPA 1">
            </div>

            <!-- Lokasi (untuk kategori ditemukan) -->
            <div id="lokasiField" class="mb-6" style="display: none;">
                <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi *</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $berita->lokasi) }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Contoh: Halaman Depan Sekolah">
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="konten" class="block text-sm font-semibold text-gray-700 mb-2">Konten *</label>
                <textarea name="konten" id="konten" rows="10" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis konten berita lengkap di sini...">{{ old('konten', $berita->konten) }}</textarea>
            </div>

            <!-- Is Published -->
            <div class="mb-8">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <div>
                        <span class="text-sm font-semibold text-gray-700">Publikasikan Berita</span>
                        <p class="text-xs text-gray-500">Berita akan tampil di halaman publik</p>
                    </div>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button type="submit" 
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    Update Berita
                </button>
                <a href="{{ route('berita.index') }}" 
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

// Dynamic field visibility based on kategori selection
document.getElementById('kategori').addEventListener('change', function() {
    const kategori = this.value;
    const lokasiTerakhirField = document.getElementById('lokasiTerakhirField');
    const lokasiField = document.getElementById('lokasiField');
    const lokasiTerakhirInput = document.getElementById('lokasi_terakhir');
    const lokasiInput = document.getElementById('lokasi');
    
    // Hide all location fields first
    lokasiTerakhirField.style.display = 'none';
    lokasiField.style.display = 'none';
    
    // Remove required attribute from both inputs
    lokasiTerakhirInput.removeAttribute('required');
    lokasiInput.removeAttribute('required');
    
    // Show appropriate field based on kategori
    if (kategori === 'kehilangan') {
        lokasiTerakhirField.style.display = 'block';
        lokasiTerakhirInput.setAttribute('required', 'required');
    } else if (kategori === 'ditemukan') {
        lokasiField.style.display = 'block';
        lokasiInput.setAttribute('required', 'required');
    }
});

// Trigger change event on page load to show correct field
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategori');
    if (kategoriSelect.value) {
        kategoriSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
