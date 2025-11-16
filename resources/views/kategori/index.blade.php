@extends('layouts.app')

@section('page-title', 'Manajemen Kategori')
@section('page-subtitle', 'Kelola kategori galeri foto')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Kategori</h2>
            <p class="text-sm text-gray-600 mt-1">Total: {{ $kategori->count() }} kategori</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition flex items-center space-x-2 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Kategori</span>
        </a>
    </div>

    @if($kategori->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kategori as $item)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 card-hover border border-gray-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="text-4xl">{{ $item->icon ?? '📁' }}</div>
                        <div class="flex space-x-2">
                            <a href="{{ route('kategori.show', $item->id) }}" class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition" title="Lihat Foto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('kategori.edit', $item->id) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Slug: <code class="text-blue-600">{{ $item->slug }}</code></span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">
                            {{ $item->fotos_count ?? 0 }} Foto
                        </span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-200 text-xs text-gray-500">
                        Dibuat: {{ $item->created_at->format('d M Y') }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Kategori</h3>
            <p class="text-gray-600 mb-6">Mulai dengan membuat kategori pertama untuk mengorganisir galeri foto</p>
            <a href="{{ route('kategori.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                Buat Kategori Pertama
            </a>
        </div>
    @endif
</div>
@endsection
