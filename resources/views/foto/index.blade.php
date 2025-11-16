@extends('layouts.app')

@section('page-title', 'Manajemen Foto')
@section('page-subtitle', 'Upload dan kelola galeri foto sekolah')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Galeri Foto</h2>
            <p class="text-sm text-gray-600 mt-1">Total: {{ $fotos->total() }} foto</p>
        </div>
        <a href="{{ route('foto.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition flex items-center space-x-2 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Upload Foto</span>
        </a>
    </div>

    @if($fotos->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($fotos as $foto)
                <div class="bg-white rounded-xl overflow-hidden shadow-md card-hover border border-gray-200">
                    <!-- Image -->
                    <div class="relative h-48 bg-gray-200">
                        <img src="{{ $foto->path }}" alt="{{ $foto->alt_text }}" class="w-full h-full object-cover">
                        
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 flex flex-col gap-2">
                            @if($foto->kategori)
                                <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full font-semibold">
                                    {{ $foto->kategori->icon ?? '📁' }} {{ $foto->kategori->nama }}
                                </span>
                            @endif
                            @if($foto->is_featured)
                                <span class="px-2 py-1 bg-yellow-500 text-white text-xs rounded-full font-bold">
                                    ⭐ Unggulan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-1 line-clamp-1">{{ $foto->judul }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $foto->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('foto.edit', $foto->id) }}" class="flex-1 px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-semibold hover:bg-blue-200 transition text-center">
                                Edit
                            </a>
                            <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus foto ini?')" class="w-full px-3 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-semibold hover:bg-red-200 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $fotos->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Foto</h3>
            <p class="text-gray-600 mb-6">Mulai upload foto pertama untuk galeri sekolah</p>
            <a href="{{ route('foto.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                Upload Foto Pertama
            </a>
        </div>
    @endif
</div>
@endsection
