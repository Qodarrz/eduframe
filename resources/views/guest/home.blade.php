@extends('layouts.guest-app')

@section('content')
<!-- Hero Section -->
<section class="bg-futuristic min-h-screen flex items-center relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 rounded-full blur-3xl animate-pulse" style="background-color: #FFC857;"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full blur-3xl animate-pulse delay-1000" style="background-color: #00C2A8;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Content -->
            <div class="text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Selamat Datang di
                    <span style="color: #FFC857;">Eduframe</span>
                    Website Galery Sekolah
                </h1>
                <p class="text-xl text-gray-200 mb-8">
                    Dokumentasi visual perjalanan pendidikan, prestasi, dan momen berharga dalam satu platform modern dan futuristik.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('galeri') }}" class="px-8 py-4 rounded-lg font-bold text-lg btn-glow transition" style="background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%); color: #1C1C2E;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        Jelajahi Galeri
                    </a>
                    <a href="{{ route('info') }}" class="px-8 py-4 glass text-white rounded-lg font-bold text-lg hover:bg-white hover:bg-opacity-20 transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <!-- Right Content - Featured Image Grid -->
            <div class="grid grid-cols-2 gap-4">
                @if($featuredPhotos->count() >= 4)
                    <div class="space-y-4">
                        <div class="h-48 rounded-2xl glass card-hover overflow-hidden">
                            <img src="{{ $featuredPhotos[0]->path }}" alt="{{ $featuredPhotos[0]->alt_text }}" class="w-full h-full object-cover">
                        </div>
                        <div class="h-64 rounded-2xl glass card-hover overflow-hidden">
                            <img src="{{ $featuredPhotos[1]->path }}" alt="{{ $featuredPhotos[1]->alt_text }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="h-64 rounded-2xl glass card-hover overflow-hidden">
                            <img src="{{ $featuredPhotos[2]->path }}" alt="{{ $featuredPhotos[2]->alt_text }}" class="w-full h-full object-cover">
                        </div>
                        <div class="h-48 rounded-2xl glass card-hover overflow-hidden">
                            <img src="{{ $featuredPhotos[3]->path }}" alt="{{ $featuredPhotos[3]->alt_text }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                @else
                    <!-- Fallback jika foto unggulan kurang dari 4 -->
                    <div class="space-y-4">
                        <div class="h-48 rounded-2xl glass card-hover flex items-center justify-center" style="background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%);">
                            <p class="text-white font-bold">Upload Foto Unggulan</p>
                        </div>
                        <div class="h-64 rounded-2xl glass card-hover" style="background: linear-gradient(135deg, #00C2A8 0%, #009688 100%);"></div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="h-64 rounded-2xl glass card-hover" style="background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);"></div>
                        <div class="h-48 rounded-2xl glass card-hover" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Sejarah Sekolah Section -->
@php
    $sejarahSekolah = \App\Models\Informasi::published()->byTipe('sejarah')->ordered()->first();
@endphp

@if($sejarahSekolah)
<section class="py-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Sejarah Sekolah - Kiri (2/3) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden h-full">
                    <!-- Header dengan Gradient -->
                    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-6 md:p-8">
                        <div class="flex items-center justify-center">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white">{{ $sejarahSekolah->judul }}</h2>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 md:p-8">
                        @if($sejarahSekolah->gambar)
                        <!-- Gambar -->
                        <div class="mb-6">
                            <div class="rounded-2xl overflow-hidden shadow-xl">
                                <img src="{{ $sejarahSekolah->gambar }}" 
                                     alt="{{ $sejarahSekolah->judul }}" 
                                     class="w-full h-64 object-cover">
                            </div>
                        </div>
                        @endif
                        
                        <!-- Konten -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                            {!! nl2br(e($sejarahSekolah->konten)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Cepat - Kanan (1/3) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-2xl p-6 sticky top-24">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
                        <svg class="w-7 h-7 mr-2" style="color: #6155F5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Menu Cepat
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('galeri') }}" class="flex items-center space-x-3 p-4 rounded-xl transition card-hover" style="background: linear-gradient(135deg, rgba(97, 85, 245, 0.1) 0%, rgba(97, 85, 245, 0.15) 100%);" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #6155F5;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Galeri Foto</p>
                                <p class="text-xs text-gray-600">Lihat koleksi foto</p>
                            </div>
                        </a>

                        <a href="{{ route('info') }}" class="flex items-center space-x-3 p-4 rounded-xl transition card-hover" style="background: linear-gradient(135deg, rgba(0, 194, 168, 0.1) 0%, rgba(0, 194, 168, 0.15) 100%);" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #00C2A8;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">About School</p>
                                <p class="text-xs text-gray-600">Pelajari tentang sekolah</p>
                            </div>
                        </a>

                        <a href="{{ route('guest.berita') }}" class="flex items-center space-x-3 p-4 rounded-xl transition card-hover" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.15) 100%);" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #EF4444;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Berita</p>
                                <p class="text-xs text-gray-600">Informasi terkini</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

<!-- Visi Misi Section -->
@php
    $visi = \App\Models\Informasi::published()->byTipe('visi')->ordered()->first();
    $misi = \App\Models\Informasi::published()->byTipe('misi')->ordered()->first();
@endphp

@if($visi || $misi)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Visi -->
            @if($visi)
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl shadow-xl overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white">{{ $visi->judul }}</h3>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    @if($visi->gambar)
                    <div class="mb-6">
                        <div class="rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ $visi->gambar }}" 
                                 alt="{{ $visi->judul }}" 
                                 class="w-full h-48 object-cover">
                        </div>
                    </div>
                    @endif
                    <div class="text-gray-700 leading-relaxed text-justify">
                        {!! nl2br(e($visi->konten)) !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Misi -->
            @if($misi)
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-3xl shadow-xl overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-green-600 to-green-700 p-6">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white">{{ $misi->judul }}</h3>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    @if($misi->gambar)
                    <div class="mb-6">
                        <div class="rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ $misi->gambar }}" 
                                 alt="{{ $misi->judul }}" 
                                 class="w-full h-48 object-cover">
                        </div>
                    </div>
                    @endif
                    <div class="text-gray-700 leading-relaxed text-justify">
                        {!! nl2br(e($misi->konten)) !!}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endif

<!-- Jurusan Section -->
@php
    $jurusan = \App\Models\Informasi::published()->byTipe('jurusan')->ordered()->get();
@endphp

@if($jurusan->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block p-4 bg-purple-100 rounded-full mb-4">
                <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">🎓 Program Keahlian</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-purple-400 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($jurusan as $index => $item)
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl shadow-lg card-hover border-t-4 border-purple-600 cursor-pointer transform transition-transform hover:scale-105 p-6" onclick="openJurusanModalHome({{ $index }})">
                    <div class="flex flex-col items-center text-center">
                        @if($item->gambar)
                            <div class="w-40 h-40 mb-4 rounded-full overflow-hidden shadow-lg border-4 border-white bg-white">
                                <img src="{{ $item->gambar }}" alt="{{ $item->judul }}" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-40 h-40 mb-4 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center shadow-lg border-4 border-white">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-700 text-sm leading-relaxed mb-3">{{ Str::limit($item->konten, 100) }}</p>
                        <div class="text-purple-600 text-sm font-semibold flex items-center">
                            <span>Lihat Detail</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal Jurusan -->
<div id="jurusanModalHome" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4" onclick="closeJurusanModalHome()">
    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="sticky top-0 bg-gradient-to-r from-purple-600 to-purple-700 p-6 flex justify-between items-center rounded-t-3xl">
            <h2 id="modalTitleHome" class="text-2xl font-bold text-white"></h2>
            <button onclick="closeJurusanModalHome()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div id="modalImageHome"></div>
                <div id="modalContentHome" class="text-gray-700 leading-relaxed text-justify whitespace-pre-line"></div>
            </div>
        </div>
    </div>
</div>

<script>
const jurusanDataHome = [
    @foreach($jurusan as $item)
    {
        judul: @json($item->judul),
        konten: @json($item->konten),
        gambar: @json($item->gambar ? $item->gambar : null)
    },
    @endforeach
];

function openJurusanModalHome(index) {
    const data = jurusanDataHome[index];
    document.getElementById('modalTitleHome').textContent = data.judul;
    document.getElementById('modalContentHome').textContent = data.konten;
    
    const modalImage = document.getElementById('modalImageHome');
    if (data.gambar) {
        modalImage.innerHTML = `<img src="${data.gambar}" alt="${data.judul}" class="w-full h-full object-cover rounded-2xl shadow-lg">`;
    } else {
        modalImage.innerHTML = '';
        modalImage.classList.add('hidden');
        document.getElementById('modalContentHome').classList.remove('lg:col-span-1');
        document.getElementById('modalContentHome').classList.add('lg:col-span-2');
    }
    
    document.getElementById('jurusanModalHome').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeJurusanModalHome() {
    document.getElementById('jurusanModalHome').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endif

<!-- Featured Photos Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Foto Unggulan</h2>
            <p class="text-xl text-gray-600">Momen-momen terbaik yang kami dokumentasikan</p>
        </div>

        <div id="featured-photos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loading State -->
            <div class="col-span-full text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-yellow-500 border-t-transparent"></div>
                <p class="mt-4 text-gray-600">Memuat foto unggulan...</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('galeri') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg font-bold text-lg btn-glow hover:from-yellow-600 hover:to-yellow-700 transition">
                Lihat Semua Galeri →
            </a>
        </div>
    </div>
</section>


@push('scripts')
<script>
    // Animate counters
    function animateCounter(id, target) {
        let current = 0;
        const increment = target / 50;
        const element = document.getElementById(id);
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 30);
    }

    // Fetch featured photos
    async function loadFeaturedPhotos() {
        try {
            const response = await fetch('/api/gallery/featured');
            const data = await response.json();
            
            const container = document.getElementById('featured-photos');
            
            if (data.success && data.data.length > 0) {
                container.innerHTML = data.data.map(foto => `
                    <div class="card-hover rounded-2xl overflow-hidden shadow-lg bg-white">
                        <div class="h-64 bg-gradient-to-br from-gray-200 to-gray-300 relative">
                            <img src="${foto.url}" alt="${foto.alt_text}" class="w-full h-full object-cover">
                            ${foto.kategori ? `
                                <span class="absolute top-4 left-4 px-3 py-1 bg-yellow-500 text-gray-900 rounded-full text-sm font-semibold">
                                    ${foto.kategori.icon || '📸'} ${foto.kategori.nama}
                                </span>
                            ` : ''}
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">${foto.judul}</h3>
                            <p class="text-gray-600 line-clamp-2">${foto.deskripsi || 'Tidak ada deskripsi'}</p>
                        </div>
                    </div>
                `).join('');
                
                animateCounter('foto-count', data.data.length);
            } else {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada foto unggulan</p>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading featured photos:', error);
            document.getElementById('featured-photos').innerHTML = `
                <div class="col-span-full text-center py-12">
                    <p class="text-red-500">Gagal memuat foto unggulan</p>
                </div>
            `;
        }
    }

    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadFeaturedPhotos();
        animateCounter('agenda-count', 12); // Dummy count
    });
</script>
@endpush
@endsection
