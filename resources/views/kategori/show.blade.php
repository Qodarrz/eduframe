@extends('layouts.app')

@section('page-title', $kategori->nama)
@section('page-subtitle', $kategori->deskripsi ?? 'Lihat semua foto dalam kategori ini')

@section('content')
<div class="mb-6">
    <a href="{{ route('kategori.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Kategori
    </a>
</div>

<!-- Kategori Info Card -->
<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
    <div class="flex items-center gap-4">
        @if($kategori->icon)
            <div class="text-6xl">{{ $kategori->icon }}</div>
        @else
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-2">{{ $kategori->nama }}</h1>
            @if($kategori->deskripsi)
                <p class="text-blue-100 text-lg">{{ $kategori->deskripsi }}</p>
            @endif
            <div class="mt-3 flex items-center gap-4 text-sm">
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full">
                    {{ $fotos->total() }} Foto
                </span>
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full">
                    Slug: {{ $kategori->slug }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Photos Grid -->
@if($fotos->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($fotos as $foto)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                <div class="relative h-64 bg-gray-200">
                    <img src="{{ $foto->path }}" 
                         alt="{{ $foto->alt_text }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    
                    @if($foto->is_featured)
                        <div class="absolute top-3 right-3">
                            <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                ⭐ Unggulan
                            </span>
                        </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-1">{{ $foto->judul }}</h3>
                    @if($foto->deskripsi)
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $foto->deskripsi }}</p>
                    @endif
                    
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $foto->created_at->format('d M Y') }}</span>
                        <span>{{ number_format($foto->file_size / 1024, 0) }} KB</span>
                    </div>
                    
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('foto.edit', $foto->id) }}" 
                           class="flex-1 px-3 py-2 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition text-center">
                            Edit
                        </a>
                        <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                    class="w-full px-3 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
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
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Foto</h3>
        <p class="text-gray-600 mb-6">Kategori ini belum memiliki foto. Upload foto baru untuk kategori ini.</p>
        <a href="{{ route('foto.create') }}" 
           class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
            Upload Foto Baru
        </a>
    </div>
@endif
@endsection
