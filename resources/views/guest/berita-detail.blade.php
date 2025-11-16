@extends('layouts.guest-app')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-gradient-to-r from-blue-600 to-blue-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('guest.berita') }}" class="inline-flex items-center text-white hover:text-yellow-300 mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Berita
        </a>
        <h1 class="text-4xl md:text-5xl font-bold text-white">{{ $berita->judul }}</h1>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    @if($berita->gambar)
                        <div class="h-96">
                            <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <div class="flex items-center text-sm text-gray-500 mb-6 pb-6 border-b">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $berita->created_at->format('d F Y, H:i') }} WIB
                        </div>
                        
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($berita->konten)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Berita Terbaru
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($latestBerita as $latest)
                            @if($latest->id != $berita->id)
                                <a href="{{ route('guest.berita.detail', $latest->id) }}" class="block group">
                                    <div class="flex gap-3">
                                        @if($latest->gambar)
                                            <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                                                <img src="{{ $latest->gambar }}" alt="{{ $latest->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-2">{{ $latest->judul }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ $latest->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t">
                        <a href="{{ route('guest.berita') }}" class="block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Lihat Semua Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
