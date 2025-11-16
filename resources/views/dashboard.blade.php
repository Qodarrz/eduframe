@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview statistik dan aktivitas terkini')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Foto -->
    <div class="rounded-2xl p-6 text-white card-hover animate-slide-up" style="background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold mb-1">{{ \App\Models\Foto::count() }}</h3>
        <p style="color: rgba(255, 255, 255, 0.8);">Total Foto</p>
    </div>

    <!-- Total Kategori -->
    <div class="rounded-2xl p-6 text-white card-hover animate-slide-up" style="background: linear-gradient(135deg, #00C2A8 0%, #009688 100%); animation-delay: 0.1s">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold mb-1">{{ \App\Models\Kategori::count() }}</h3>
        <p style="color: rgba(255, 255, 255, 0.8);">Total Kategori</p>
    </div>

    <!-- Foto Unggulan -->
    <div class="rounded-2xl p-6 text-white card-hover animate-slide-up" style="background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%); animation-delay: 0.2s">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold mb-1">{{ \App\Models\Foto::where('is_featured', true)->count() }}</h3>
        <p style="color: rgba(255, 255, 255, 0.8);">Foto Unggulan</p>
    </div>

</div>

<!-- Second Row Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Total Informasi -->
    <div class="rounded-2xl p-6 text-white card-hover animate-slide-up" style="background: linear-gradient(135deg, #FFC857 0%, #00C2A8 100%);">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold mb-1">{{ \App\Models\Informasi::count() }}</h3>
        <p style="color: rgba(255, 255, 255, 0.8);">Total Informasi</p>
    </div>

</div>

<!-- Quick Actions & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4" style="color: #1C1C2E;">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('foto.index') }}" class="flex items-center space-x-3 p-3 rounded-lg transition" style="background-color: rgba(97, 85, 245, 0.1);" onmouseover="this.style.backgroundColor='rgba(97, 85, 245, 0.2)'" onmouseout="this.style.backgroundColor='rgba(97, 85, 245, 0.1)'">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #6155F5;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Upload Foto</p>
                        <p class="text-xs text-gray-600">Tambah foto baru</p>
                    </div>
                </a>

                <a href="{{ route('kategori.index') }}" class="flex items-center space-x-3 p-3 rounded-lg transition" style="background-color: rgba(0, 194, 168, 0.1);" onmouseover="this.style.backgroundColor='rgba(0, 194, 168, 0.2)'" onmouseout="this.style.backgroundColor='rgba(0, 194, 168, 0.1)'">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #00C2A8;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Kelola Kategori</p>
                        <p class="text-xs text-gray-600">Atur kategori galeri</p>
                    </div>
                </a>

<a href="{{ route('informasi.create') }}" class="flex items-center space-x-3 p-3 rounded-lg transition" style="background-color: rgba(28, 28, 46, 0.05);" onmouseover="this.style.backgroundColor='rgba(28, 28, 46, 0.1)'" onmouseout="this.style.backgroundColor='rgba(28, 28, 46, 0.05)'">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Tambah Informasi</p>
                        <p class="text-xs text-gray-600">Buat pengumuman</p>
                    </div>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 p-3 rounded-lg transition" style="background-color: rgba(28, 28, 46, 0.05);" onmouseover="this.style.backgroundColor='rgba(28, 28, 46, 0.1)'" onmouseout="this.style.backgroundColor='rgba(28, 28, 46, 0.05)'">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #1C1C2E;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Lihat Website</p>
                        <p class="text-xs text-gray-600">Preview tampilan publik</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Photos -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold" style="color: #1C1C2E;">Foto Terbaru</h3>
                <a href="{{ route('foto.index') }}" class="text-sm font-semibold" style="color: #6155F5;" onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'">Lihat Semua →</a>
            </div>

            @php
                $recentFotos = \App\Models\Foto::with('kategori')->latest()->take(6)->get();
            @endphp

            @if($recentFotos->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($recentFotos as $foto)
                        <div class="relative group rounded-lg overflow-hidden card-hover">
                            <div class="aspect-square bg-gray-200">
                                <img src="{{ $foto->path }}" alt="{{ $foto->alt_text }}" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="absolute bottom-0 left-0 right-0 p-3">
                                    <p class="text-white text-sm font-semibold line-clamp-1">{{ $foto->judul }}</p>
                                    @if($foto->kategori)
                                        <p class="text-gray-300 text-xs">{{ $foto->kategori->nama }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-500 font-semibold mb-2">Belum Ada Foto</p>
                    <p class="text-gray-400 text-sm mb-4">Mulai upload foto pertama Anda</p>
                    <a href="{{ route('foto.index') }}" class="inline-block px-6 py-2 text-white rounded-lg font-semibold transition" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        Upload Foto
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Categories Overview -->
<div class="mt-6">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold" style="color: #1C1C2E;">Kategori Galeri</h3>
            <a href="{{ route('kategori.index') }}" class="text-sm font-semibold" style="color: #6155F5;" onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'">Kelola →</a>
        </div>

        @php
            $kategoris = \App\Models\Kategori::withCount('fotos')->get();
        @endphp

        @if($kategoris->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($kategoris as $kategori)
                    <div class="p-4 rounded-xl text-center card-hover" style="background: linear-gradient(135deg, rgba(97, 85, 245, 0.05) 0%, rgba(0, 194, 168, 0.05) 100%);">
                        <div class="text-3xl mb-2">{{ $kategori->icon ?? '📁' }}</div>
                        <h4 class="font-bold text-gray-900 mb-1">{{ $kategori->nama }}</h4>
                        <p class="text-sm text-gray-600">{{ $kategori->fotos_count }} Foto</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada kategori. <a href="{{ route('kategori.index') }}" class="font-semibold" style="color: #6155F5;" onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'">Buat kategori pertama</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
