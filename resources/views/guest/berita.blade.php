@extends('layouts.guest-app')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/header-info.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/85 to-green-800/90"></div>
    </div>
    
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-yellow-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-green-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg">Berita & Artikel</h1>
        <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6 drop-shadow-lg">SMK Negeri 4 Kota Bogor</h2>
        <p class="text-xl text-gray-100 max-w-3xl mx-auto drop-shadow-md">
            Informasi terkini dan artikel menarik seputar kegiatan sekolah
        </p>
    </div>
</section>

<!-- Berita Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="mb-8">
            <form action="{{ route('guest.berita') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari berita..." 
                           class="w-full px-6 py-4 pl-14 text-gray-700 bg-white border border-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    <svg class="absolute left-5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    @if(request('search') || request('kategori'))
                        <a href="{{ route('guest.berita') }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
                <!-- Preserve category filter when searching -->
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
            </form>
        </div>

        <!-- Category Filter -->
        <div class="mb-12">
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('guest.berita') }}" 
                   class="px-6 py-3 rounded-full font-semibold transition-all duration-300 {{ !request('kategori') ? 'bg-blue-600 text-white shadow-lg scale-105' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    Semua Kategori
                </a>
                <a href="{{ route('guest.berita') }}?kategori=prestasi sekolah{{ request('search') ? '&search=' . urlencode(request('search')) : '' }}" 
                   class="px-6 py-3 rounded-full font-semibold transition-all duration-300 {{ request('kategori') == 'prestasi sekolah' ? 'bg-purple-600 text-white shadow-lg scale-105' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Prestasi Sekolah
                    </span>
                </a>
                <a href="{{ route('guest.berita') }}?kategori=agenda{{ request('search') ? '&search=' . urlencode(request('search')) : '' }}" 
                   class="px-6 py-3 rounded-full font-semibold transition-all duration-300 {{ request('kategori') == 'agenda' ? 'bg-yellow-500 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Agenda
                </a>
                <a href="{{ route('guest.berita') }}?kategori=kehilangan{{ request('search') ? '&search=' . urlencode(request('search')) : '' }}" 
                   class="px-6 py-3 rounded-full font-semibold transition-all duration-300 {{ request('kategori') == 'kehilangan' ? 'bg-orange-600 text-white shadow-lg scale-105' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 7a5 5 0 11-4.546-2.914A5.986 5.986 0 0110 16a5.976 5.976 0 004.546-2.914A5 5 0 118 7zm5-4a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1h-1a1 1 0 01-1-1V3z" clip-rule="evenodd"/>
                        </svg>
                        Kehilangan
                    </span>
                </a>
                <a href="{{ route('guest.berita') }}?kategori=ditemukan{{ request('search') ? '&search=' . urlencode(request('search')) : '' }}" 
                   class="px-6 py-3 rounded-full font-semibold transition-all duration-300 {{ request('kategori') == 'ditemukan' ? 'bg-teal-600 text-white shadow-lg scale-105' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Ditemukan
                    </span>
                </a>
            </div>
        </div>
        
        @if($beritas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritas as $berita)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                        @if($berita->gambar)
                            <div class="h-56 bg-gray-200">
                                <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-56 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $berita->created_at->format('d F Y') }}
                                @if($berita->penulis)
                                    <span class="mx-2">•</span>
                                    <span>{{ $berita->penulis }}</span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $berita->judul }}</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">{{ Str::limit($berita->konten, 150) }}</p>
                            
                            <a href="{{ route('guest.berita.detail', $berita->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($beritas->hasPages())
                <div class="mt-12">
                    {{ $beritas->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-600">Berita akan segera ditambahkan</p>
            </div>
        @endif
    </div>
</section>
@endsection
