@extends('layouts.app')

@section('page-title', 'Manajemen Informasi')
@section('page-subtitle', 'Kelola informasi dan pengumuman sekolah')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Informasi</h2>
            <p class="text-sm text-gray-600 mt-1">Total: {{ $informasis->total() }} informasi</p>
        </div>
        <a href="{{ route('informasi.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition flex items-center space-x-2 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Informasi</span>
        </a>
    </div>

    @if($informasis->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($informasis as $info)
                <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition card-hover">
                    @if($info->gambar)
                        <div class="h-48 bg-gray-200">
                            <img src="{{ $info->gambar }}" alt="{{ $info->judul }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <h3 class="text-xl font-bold text-gray-900 flex-1">{{ $info->judul }}</h3>
                            @if($info->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-semibold">Published</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full font-semibold">Draft</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-2 mb-3">
                            @if($info->tipe == 'visi')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-semibold">🎯 Visi</span>
                            @elseif($info->tipe == 'misi')
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded font-semibold">🚀 Misi</span>
                            @elseif($info->tipe == 'sejarah')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded font-semibold">📜 Sejarah</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded font-semibold">📢 Umum</span>
                            @endif
                            <span class="text-xs text-gray-500">Urutan: {{ $info->urutan }}</span>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($info->konten, 150) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>{{ $info->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('informasi.edit', $info->id) }}" class="flex-1 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-center font-semibold hover:bg-blue-200 transition">
                                Edit
                            </a>
                            <form action="{{ route('informasi.destroy', $info->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus informasi ini?')" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg font-semibold hover:bg-red-200 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $informasis->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Informasi</h3>
            <p class="text-gray-600 mb-6">Mulai dengan membuat informasi pertama untuk pengumuman sekolah</p>
            <a href="{{ route('informasi.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                Buat Informasi Pertama
            </a>
        </div>
    @endif
</div>
@endsection
