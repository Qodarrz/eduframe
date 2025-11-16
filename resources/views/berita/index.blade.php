@extends('layouts.app')

@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Manajemen berita dan artikel')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
    <a href="{{ route('berita.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Berita Baru
    </a>
    
    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('berita.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari berita..." 
                class="w-full sm:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <select name="kategori" onchange="this.form.submit()" 
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Semua Kategori</option>
            <option value="kehilangan" {{ request('kategori') == 'kehilangan' ? 'selected' : '' }}>Kehilangan</option>
            <option value="ditemukan" {{ request('kategori') == 'ditemukan' ? 'selected' : '' }}>Ditemukan</option>
            <option value="prestasi sekolah" {{ request('kategori') == 'prestasi sekolah' ? 'selected' : '' }}>Prestasi Sekolah</option>
            <option value="agenda" {{ request('kategori') == 'agenda' ? 'selected' : '' }}>Agenda</option>
        </select>
        
        @if(request('search') || request('kategori'))
            <a href="{{ route('berita.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                Reset
            </a>
        @endif
    </form>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Gambar</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($beritas as $berita)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            @if($berita->gambar)
                                <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $berita->judul }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($berita->konten, 60) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @switch($berita->kategori)
                                @case('kehilangan')
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Kehilangan</span>
                                    @if($berita->lokasi_terakhir)
                                        <div class="text-xs text-gray-500 mt-1">Lokasi: {{ $berita->lokasi_terakhir }}</div>
                                    @endif
                                    @break
                                @case('ditemukan')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Ditemukan</span>
                                    @if($berita->lokasi)
                                        <div class="text-xs text-gray-500 mt-1">Lokasi: {{ $berita->lokasi }}</div>
                                    @endif
                                    @break
                                @case('prestasi sekolah')
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Prestasi Sekolah</span>
                                    @break
                                @case('agenda')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Agenda</span>
                                    @break
                                @case('prestasi')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Prestasi</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">{{ $berita->kategori }}</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            @if($berita->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Published</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $berita->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('berita.edit', $berita->id) }}" class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-sm font-semibold">
                                    Edit
                                </a>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <p class="text-lg font-semibold">Belum ada berita</p>
                            <p class="text-sm">Klik tombol "Tambah Berita" untuk membuat berita baru</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($beritas->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $beritas->links() }}
        </div>
    @endif
</div>
@endsection
