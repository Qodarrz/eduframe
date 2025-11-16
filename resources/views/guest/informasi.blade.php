@extends('layouts.guest-app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="relative py-32 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/header-info.jpg') }}');">
        <!-- Dark Overlay for better text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/85 to-green-800/90"></div>
    </div>
    
    <!-- Animated Accent Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-yellow-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-green-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg">Website Galeri</h1>
        <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6 drop-shadow-lg">SMK Negeri 4 Kota Bogor</h2>
        <p class="text-xl text-gray-100 max-w-3xl mx-auto drop-shadow-md">
            Mengenal lebih dekat visi, misi, dan sejarah sekolah kami
        </p>
    </div>
</section>

@php
    $visiItems = $informasis->where('tipe', 'visi')->sortBy('urutan');
    $misiItems = $informasis->where('tipe', 'misi')->sortBy('urutan');
    $sejarahItems = $informasis->where('tipe', 'sejarah')->sortBy('urutan');
    $jurusanItems = $informasis->where('tipe', 'jurusan')->sortBy('urutan');
    $umumItems = $informasis->where('tipe', 'umum')->sortBy('urutan');
@endphp

<!-- Sejarah, Visi & Misi Section -->
@if($sejarahItems->count() > 0 || $visiItems->count() > 0 || $misiItems->count() > 0)
<section class="py-20 bg-gradient-to-br from-blue-50 via-purple-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Sejarah Section - Kiri (2/3) -->
            @if($sejarahItems->count() > 0)
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden h-full">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-yellow-600 via-orange-600 to-yellow-600 p-6">
                        <div class="flex items-center justify-center">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white">📜 Sejarah Sekolah</h2>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6 md:p-8 space-y-8">
                        @foreach($sejarahItems as $sejarah)
                            <div>
                                @if($sejarah->gambar)
                                    <div class="mb-6 rounded-2xl overflow-hidden shadow-lg">
                                        <img src="{{ $sejarah->gambar }}" alt="{{ $sejarah->judul }}" class="w-full h-64 object-cover">
                                    </div>
                                @endif
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $sejarah->judul }}</h3>
                                <div class="text-gray-700 leading-relaxed text-justify whitespace-pre-line">{{ $sejarah->konten }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Visi & Misi - Kanan (1/3) -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Visi Section - Atas -->
                @if($visiItems->count() > 0)
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl shadow-xl overflow-hidden card-hover">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-5">
                        <div class="flex items-center justify-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">🎯 Visi</h3>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        @foreach($visiItems as $visi)
                            <div>
                                @if($visi->gambar)
                                    <div class="mb-3 rounded-xl overflow-hidden shadow-md">
                                        <img src="{{ $visi->gambar }}" alt="{{ $visi->judul }}" class="w-full h-32 object-cover">
                                    </div>
                                @endif
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $visi->judul }}</h4>
                                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $visi->konten }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Misi Section - Bawah -->
                @if($misiItems->count() > 0)
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-3xl shadow-xl overflow-hidden card-hover">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 p-5">
                        <div class="flex items-center justify-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">🚀 Misi</h3>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        @foreach($misiItems as $misi)
                            <div>
                                @if($misi->gambar)
                                    <div class="mb-3 rounded-xl overflow-hidden shadow-md">
                                        <img src="{{ $misi->gambar }}" alt="{{ $misi->judul }}" class="w-full h-32 object-cover">
                                    </div>
                                @endif
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $misi->judul }}</h4>
                                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $misi->konten }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

        </div>
    </div>
</section>
@endif

<!-- Jurusan Section -->
@if($jurusanItems->count() > 0)
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
            @foreach($jurusanItems as $index => $jurusan)
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl shadow-lg card-hover border-t-4 border-purple-600 cursor-pointer transform transition-transform hover:scale-105 p-6" onclick="openJurusanModal({{ $index }})">
                    <div class="flex flex-col items-center text-center">
                        @if($jurusan->gambar)
                            <div class="w-40 h-40 mb-4 rounded-full overflow-hidden shadow-lg border-4 border-white bg-white">
                                <img src="{{ $jurusan->gambar }}" alt="{{ $jurusan->judul }}" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-40 h-40 mb-4 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center shadow-lg border-4 border-white">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $jurusan->judul }}</h3>
                        <p class="text-gray-700 text-sm leading-relaxed mb-3">{{ Str::limit($jurusan->konten, 100) }}</p>
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
<div id="jurusanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4" onclick="closeJurusanModal()">
    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="sticky top-0 bg-gradient-to-r from-purple-600 to-purple-700 p-6 flex justify-between items-center rounded-t-3xl">
            <h2 id="modalTitle" class="text-2xl font-bold text-white"></h2>
            <button onclick="closeJurusanModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div id="modalImage"></div>
                <div id="modalContent" class="text-gray-700 leading-relaxed text-justify whitespace-pre-line"></div>
            </div>
        </div>
    </div>
</div>

<script>
const jurusanData = [
    @foreach($jurusanItems as $jurusan)
    {
        judul: @json($jurusan->judul),
        konten: @json($jurusan->konten),
        gambar: @json($jurusan->gambar ? $jurusan->gambar : null)
    },
    @endforeach
];

function openJurusanModal(index) {
    const data = jurusanData[index];
    document.getElementById('modalTitle').textContent = data.judul;
    document.getElementById('modalContent').textContent = data.konten;
    
    const modalImage = document.getElementById('modalImage');
    if (data.gambar) {
        modalImage.innerHTML = `<img src="${data.gambar}" alt="${data.judul}" class="w-full h-full object-cover rounded-2xl shadow-lg">`;
    } else {
        modalImage.innerHTML = '';
        modalImage.classList.add('hidden');
        document.getElementById('modalContent').classList.remove('lg:col-span-1');
        document.getElementById('modalContent').classList.add('lg:col-span-2');
    }
    
    document.getElementById('jurusanModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeJurusanModal() {
    document.getElementById('jurusanModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeJurusanModal();
    }
});
</script>
@endif

<!-- Quick Links Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">🔗 Informasi Lainnya</h2>
            <p class="text-blue-100">Jelajahi informasi lebih lanjut tentang sekolah kami</p>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('tenaga-pendidikan') }}" class="group bg-white hover:bg-yellow-400 text-gray-900 px-8 py-4 rounded-xl font-bold text-lg shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span>👨‍🏫 Lihat Tenaga Pendidikan</span>
                <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Informasi Umum Section -->
@if($umumItems->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">📢 Informasi & Pengumuman</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-green-600 to-green-400 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($umumItems as $info)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                    @if($info->gambar)
                        <div class="h-56 bg-gray-200">
                            <img src="{{ $info->gambar }}" alt="{{ $info->judul }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $info->judul }}</h3>
                        <p class="text-gray-700 leading-relaxed mb-4 whitespace-pre-line">{{ Str::limit($info->konten, 200) }}</p>
                        <div class="flex items-center text-sm text-gray-500 pt-4 border-t">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $info->created_at->format('d F Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Empty State -->
@if($informasis->count() == 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Informasi</h3>
            <p class="text-gray-600">Informasi akan segera ditambahkan</p>
        </div>
    </div>
</section>
@endif
@endsection
