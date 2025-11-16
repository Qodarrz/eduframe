@extends('layouts.guest-app')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-gradient-to-r from-blue-600 to-blue-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Agenda Sekolah</h1>
        <p class="text-xl text-blue-100 max-w-3xl">Jadwal dan agenda kegiatan di sekolah kami.</p>
    </div>
</section>

<!-- Agenda Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Agenda Mendatang</h2>
            <div class="w-20 h-1 bg-yellow-500 mx-auto"></div>
        </div>

        @if($agendas->count() > 0)
            <div class="space-y-6 max-w-4xl mx-auto">
                @foreach($agendas as $agenda)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover">
                        <div class="md:flex">
                            <div class="md:w-1/4 bg-gradient-to-br from-blue-500 to-blue-600 p-6 flex flex-col items-center justify-center text-white">
                                <div class="text-4xl font-bold">{{ $agenda->tanggal->format('d') }}</div>
                                <div class="text-lg uppercase">{{ $agenda->tanggal->format('M') }}</div>
                                <div class="text-sm">{{ $agenda->tanggal->format('Y') }}</div>
                                
                                @if($agenda->waktu)
                                    <div class="mt-4 text-sm font-medium bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                        {{ $agenda->formatted_time }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6 md:w-3/4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $agenda->judul }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($agenda->deskripsi, 200) }}</p>
                                
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                    @if($agenda->lokasi)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $agenda->lokasi }}
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $agenda->creator->name ?? 'Admin' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="mt-8">
                    {{ $agendas->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada agenda yang akan datang</h3>
                <p class="mt-1 text-gray-500">Silakan periksa kembali di lain waktu.</p>
            </div>
        @endif
    </div>
</section>

@if($pastAgendas->count() > 0)
<!-- Past Agenda Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Agenda Terdahulu</h2>
            <div class="w-20 h-1 bg-gray-300 mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pastAgendas as $agenda)
                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $agenda->formatted_date }}
                            @if($agenda->waktu)
                                <span class="mx-1">•</span>
                                <span>{{ $agenda->formatted_time }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $agenda->judul }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                        
                        @if($agenda->lokasi)
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $agenda->lokasi }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($pastAgendas->hasPages())
            <div class="mt-8">
                {{ $pastAgendas->links() }}
            </div>
        @endif
    </div>
</section>
@endif
@endsection
