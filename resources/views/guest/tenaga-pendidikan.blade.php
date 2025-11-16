@extends('layouts.guest-app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[40vh] bg-gradient-to-br from-blue-900 via-purple-900 to-green-900 flex items-center justify-center py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('info') }}" class="inline-flex items-center text-white hover:text-yellow-400 transition font-semibold group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Informasi
            </a>
        </div>

        <!-- Title -->
        <div class="text-center">
            <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 animate-fade-in">
                👨‍🏫 Tenaga Kependidikan SMKN 4 Kota Bogor
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Guru dan Staf yang berdedikasi untuk memberikan pendidikan terbaik
            </p>
        </div>
    </div>
</section>

<!-- Guru Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4" style="color: #1C1C2E;">
                📚 Guru
            </h2>
            <p class="text-gray-600 text-lg">Tenaga pengajar profesional dan berpengalaman</p>
        </div>

        @php
            $guru = $tenagaPendidikan->where('jenis', 'guru')->sortBy('nama');
        @endphp

        @if($guru->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($guru as $person)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Photo -->
                        <div class="relative h-64 bg-gradient-to-br from-blue-500 to-purple-500">
                            @if($person->foto)
                                <img src="{{ $person->foto }}" 
                                     alt="{{ $person->nama }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-32 h-32 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2" style="color: #1C1C2E;">{{ $person->nama }}</h3>
                            
                            @if($person->nip)
                                <p class="text-sm text-gray-500 mb-2">NIP: {{ $person->nip }}</p>
                            @endif

                            <div class="mb-3">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%); color: white;">
                                    {{ $person->jabatan }}
                                </span>
                            </div>

                            @if($person->pendidikan)
                                <p class="text-sm text-gray-600 mb-2">
                                    <span class="font-semibold">Pendidikan:</span> {{ $person->pendidikan }}
                                </p>
                            @endif

                            @if($person->bidang_keahlian)
                                <p class="text-sm text-gray-600 mb-3">
                                    <span class="font-semibold">Bidang:</span> {{ $person->bidang_keahlian }}
                                </p>
                            @endif

                            @if($person->email || $person->telepon)
                                <div class="border-t pt-3 mt-3 space-y-2">
                                    @if($person->email)
                                        <p class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="truncate">{{ $person->email }}</span>
                                        </p>
                                    @endif
                                    @if($person->telepon)
                                        <p class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $person->telepon }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada data guru</p>
            </div>
        @endif
    </div>
</section>

<!-- Staf Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4" style="color: #1C1C2E;">
                👔 Staf
            </h2>
            <p class="text-gray-600 text-lg">Tenaga kependidikan yang mendukung operasional sekolah</p>
        </div>

        @php
            $staf = $tenagaPendidikan->where('jenis', 'staf')->sortBy('nama');
        @endphp

        @if($staf->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($staf as $person)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Photo -->
                        <div class="relative h-64 bg-gradient-to-br from-green-500 to-blue-500">
                            @if($person->foto)
                                <img src="{{ $person->foto }}" 
                                     alt="{{ $person->nama }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-32 h-32 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2" style="color: #1C1C2E;">{{ $person->nama }}</h3>
                            
                            @if($person->nip)
                                <p class="text-sm text-gray-500 mb-2">NIP: {{ $person->nip }}</p>
                            @endif

                            <div class="mb-3">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold" style="background: linear-gradient(135deg, #00C2A8 0%, #6155F5 100%); color: white;">
                                    {{ $person->jabatan }}
                                </span>
                            </div>

                            @if($person->pendidikan)
                                <p class="text-sm text-gray-600 mb-2">
                                    <span class="font-semibold">Pendidikan:</span> {{ $person->pendidikan }}
                                </p>
                            @endif

                            @if($person->email || $person->telepon)
                                <div class="border-t pt-3 mt-3 space-y-2">
                                    @if($person->email)
                                        <p class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="truncate">{{ $person->email }}</span>
                                        </p>
                                    @endif
                                    @if($person->telepon)
                                        <p class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $person->telepon }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada data staf</p>
            </div>
        @endif
    </div>
</section>
@endsection
