@extends('layouts.guest-app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="relative h-[500px] overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/galeri-header.jpg') }}" 
             alt="Galeri Header" 
             class="w-full h-full object-cover">
        <!-- Dark Overlay for better text readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 h-full flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-6xl font-bold text-white mb-6 drop-shadow-2xl animate-fade-in">
                Galeri Foto
            </h1>
            <p class="text-2xl text-gray-100 max-w-3xl mx-auto drop-shadow-lg">
                Dokumentasi visual perjalanan pendidikan dan prestasi sekolah
            </p>
            
            <!-- Decorative Line -->
            <div class="mt-8 flex justify-center">
                <div class="w-24 h-1 bg-yellow-500 rounded-full"></div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Filter & Search -->
<section class="py-8 bg-white border-b sticky top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            
            <!-- Search -->
            <div class="w-full md:w-96">
                <div class="relative">
                    <input 
                        type="text" 
                        id="search-input"
                        placeholder="Cari foto..." 
                        class="w-full px-4 py-3 pl-12 rounded-lg border-2 border-gray-300 focus:border-purple-500 focus:outline-none"
                    >
                    <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2" id="category-filters">
                <button class="filter-btn active px-4 py-2 rounded-lg font-semibold transition" data-kategori="">
                    Semua
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Loading State -->
            <div class="col-span-full text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-purple-500 border-t-transparent"></div>
                <p class="mt-4 text-gray-600">Memuat galeri...</p>
            </div>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="mt-12 flex justify-center gap-2"></div>
    </div>
</section>

<!-- Modal Preview -->
<div id="photo-modal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4">
    <button id="close-modal" class="absolute top-4 right-4 text-white hover:text-yellow-400 transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <div class="max-w-5xl w-full">
        <img id="modal-image" src="" alt="" class="w-full h-auto rounded-lg mb-4">
        <div class="text-white">
            <h3 id="modal-title" class="text-2xl font-bold mb-2"></h3>
            <p id="modal-description" class="text-gray-300"></p>
            <p id="modal-category" class="mt-2 text-yellow-400"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentPage = 1;
    let currentKategori = '';
    let currentSearch = '';

    // Load categories for filter
    async function loadCategoryFilters() {
        try {
            const response = await fetch('public/api/gallery/categories');
            const data = await response.json();
            
            if (data.success && data.data.length > 0) {
                const container = document.getElementById('category-filters');
                const buttons = data.data.map(kategori => `
                    <button class="filter-btn px-4 py-2 rounded-lg font-semibold transition" data-kategori="${kategori.slug}">
                        ${kategori.icon || '📁'} ${kategori.nama}
                    </button>
                `).join('');
                
                container.innerHTML += buttons;
                
                // Add click handlers
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        currentKategori = this.dataset.kategori;
                        currentPage = 1;
                        loadGallery();
                    });
                });
            }
        } catch (error) {
            console.error('Error loading category filters:', error);
        }
    }

    // Load gallery photos
    async function loadGallery() {
        const container = document.getElementById('gallery-grid');
        container.innerHTML = `
            <div class="col-span-full text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-purple-500 border-t-transparent"></div>
                <p class="mt-4 text-gray-600">Memuat galeri...</p>
            </div>
        `;

        try {
            let url = `public/api/gallery?page=${currentPage}&per_page=12`;
            if (currentKategori) url += `&kategori=${currentKategori}`;
            if (currentSearch) url += `&search=${currentSearch}`;

            const response = await fetch(url);
            const data = await response.json();
            
            if (data.success && data.data.length > 0) {
                container.innerHTML = data.data.map(foto => `
                    <a href="/galeri/${foto.id}" class="card-hover rounded-2xl overflow-hidden shadow-lg bg-white block">
                        <div class="h-64 bg-gradient-to-br from-gray-200 to-gray-300 relative">
                            <img src="${foto.path}" alt="${foto.alt_text}" class="w-full h-full object-cover">
                            ${foto.kategori ? `
                                <span class="absolute top-3 left-3 px-3 py-1 bg-purple-600 text-white rounded-full text-xs font-semibold">
                                    ${foto.kategori.icon || '📸'} ${foto.kategori.nama}
                                </span>
                            ` : ''}
                            ${foto.is_featured ? `
                                <span class="absolute top-3 right-3 px-3 py-1 bg-yellow-500 text-gray-900 rounded-full text-xs font-bold">
                                    ⭐ Unggulan
                                </span>
                            ` : ''}
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 line-clamp-1">${foto.judul}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mt-1">${foto.deskripsi || 'Tidak ada deskripsi'}</p>
                        </div>
                    </a>
                `).join('');

                // Render pagination
                renderPagination(data.meta);
            } else {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <div class="text-6xl mb-4">📷</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Foto</h3>
                        <p class="text-gray-600">Belum ada foto yang tersedia</p>
                    </div>
                `;
                document.getElementById('pagination').innerHTML = '';
            }
        } catch (error) {
            console.error('Error loading gallery:', error);
            container.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <p class="text-red-600 font-semibold">Gagal memuat galeri</p>
                </div>
            `;
        }
    }

    // Render pagination
    function renderPagination(meta) {
        const container = document.getElementById('pagination');
        if (meta.last_page <= 1) {
            container.innerHTML = '';
            return;
        }

        let html = '';
        
        // Previous button
        if (meta.current_page > 1) {
            html += `<button onclick="changePage(${meta.current_page - 1})" class="px-4 py-2 bg-white border-2 border-purple-500 text-purple-600 rounded-lg font-semibold hover:bg-purple-50 transition">← Prev</button>`;
        }

        // Page numbers
        for (let i = 1; i <= meta.last_page; i++) {
            if (i === meta.current_page) {
                html += `<button class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold">${i}</button>`;
            } else if (i === 1 || i === meta.last_page || (i >= meta.current_page - 1 && i <= meta.current_page + 1)) {
                html += `<button onclick="changePage(${i})" class="px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">${i}</button>`;
            } else if (i === meta.current_page - 2 || i === meta.current_page + 2) {
                html += `<span class="px-2">...</span>`;
            }
        }

        // Next button
        if (meta.current_page < meta.last_page) {
            html += `<button onclick="changePage(${meta.current_page + 1})" class="px-4 py-2 bg-white border-2 border-purple-500 text-purple-600 rounded-lg font-semibold hover:bg-purple-50 transition">Next →</button>`;
        }

        container.innerHTML = html;
    }

    // Change page
    function changePage(page) {
        currentPage = page;
        loadGallery();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Open modal
    async function openModal(id) {
        try {
            const response = await fetch(`public/api/gallery/${id}`);
            const data = await response.json();
            
            if (data.success) {
                const foto = data.data;
                document.getElementById('modal-image').src = foto.url;
                document.getElementById('modal-title').textContent = foto.judul;
                document.getElementById('modal-description').textContent = foto.deskripsi || 'Tidak ada deskripsi';
                document.getElementById('modal-category').textContent = foto.kategori ? `${foto.kategori.icon || '📸'} ${foto.kategori.nama}` : '';
                document.getElementById('photo-modal').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error loading photo detail:', error);
        }
    }

    // Close modal
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('photo-modal').classList.add('hidden');
    });

    // Search functionality
    let searchTimeout;
    document.getElementById('search-input').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentSearch = e.target.value;
            currentPage = 1;
            loadGallery();
        }, 500);
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        loadCategoryFilters();
        loadGallery();
    });
</script>

<style>
    .filter-btn {
        background: white;
        border: 2px solid #e5e7eb;
        color: #374151;
    }
    
    .filter-btn:hover {
        border-color: #9333ea;
        color: #9333ea;
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
        border-color: #9333ea;
        color: white;
    }
</style>
@endpush
@endsection
