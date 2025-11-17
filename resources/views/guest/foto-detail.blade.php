@extends('layouts.guest-app')

@section('content')
<!-- Hero Section with Photo -->
<section class="relative min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-green-900 flex items-center justify-center py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('galeri') }}" class="inline-flex items-center text-white hover:text-yellow-400 transition font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Galeri
            </a>
        </div>

        <!-- Photo Card -->
        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl overflow-hidden shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                <!-- Left: Image -->
                <div class="relative h-96 lg:h-auto bg-gray-800">
                    <img src="{{ $foto->path }}" 
                         alt="{{ $foto->alt_text }}" 
                         class="w-full h-full object-cover">
                    
                    @if($foto->is_featured)
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                                ⭐ Foto Unggulan
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Right: Content -->
                <div class="p-8 lg:p-12 text-white flex flex-col justify-center">
                    <div class="mb-6">
                        @if($foto->kategori)
                            <span class="inline-block bg-blue-500 bg-opacity-30 text-blue-200 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                                {{ $foto->kategori->icon ?? '📁' }} {{ $foto->kategori->nama }}
                            </span>
                        @endif
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        {{ $foto->judul }}
                    </h1>

                    @if($foto->deskripsi)
                        <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                            {{ $foto->deskripsi }}
                        </p>
                    @endif

                    <!-- Meta Info -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $foto->created_at->format('d F Y') }}</span>
                        </div>

                        <div class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ number_format($foto->file_size / 1024, 0) }} KB</span>
                        </div>

                        @if($foto->alt_text)
                            <div class="flex items-center gap-3 text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>{{ $foto->alt_text }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $foto->path }}" 
                           download="{{ $foto->judul }}"
                           class="px-6 py-3 bg-yellow-500 text-gray-900 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Foto
                        </a>

                        @if($foto->kategori)
                            <a href="{{ route('galeri') }}?kategori={{ $foto->kategori->slug }}" 
                               class="px-6 py-3 bg-white bg-opacity-20 text-white rounded-lg font-bold hover:bg-opacity-30 transition border border-white border-opacity-30 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                Lihat Kategori Lainnya
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Removed Like & Comment Section -->

        <!-- Related Photos (Optional) -->
        @if($foto->kategori)
            @php
                $relatedPhotos = \App\Models\Foto::where('kategori_id', $foto->kategori_id)
                    ->where('id', '!=', $foto->id)
                    ->latest()
                    ->take(4)
                    ->get();
            @endphp

            @if($relatedPhotos->count() > 0)
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-white mb-8">Foto Terkait</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($relatedPhotos as $related)
                            <a href="{{ route('galeri.detail', $related->id) }}" 
                               class="group relative h-48 rounded-2xl overflow-hidden shadow-lg card-hover">
                                <img src="{{ $related->path }}" 
                                     alt="{{ $related->alt_text }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <p class="text-white font-bold text-sm line-clamp-2">{{ $related->judul }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

<script>
// Load comments on page load
document.addEventListener('DOMContentLoaded', function() {
    loadComments({{ $foto->id }});
    checkIfLiked({{ $foto->id }});
});

// Check if user already liked this foto
function checkIfLiked(fotoId) {
    const liked = localStorage.getItem('liked_foto_' + fotoId);
    if (liked === 'true') {
        document.getElementById('likeIcon').setAttribute('fill', 'currentColor');
        document.getElementById('likeText').textContent = 'Liked';
    }
}

// Toggle like
function toggleLike(fotoId) {
    fetch(`/foto/${fotoId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('likesCount').textContent = data.likes_count;
            
            const likeIcon = document.getElementById('likeIcon');
            const likeText = document.getElementById('likeText');
            
            if (data.liked) {
                likeIcon.setAttribute('fill', 'currentColor');
                likeText.textContent = 'Liked';
                localStorage.setItem('liked_foto_' + fotoId, 'true');
            } else {
                likeIcon.setAttribute('fill', 'none');
                likeText.textContent = 'Like';
                localStorage.removeItem('liked_foto_' + fotoId);
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Submit comment
function submitComment(event, fotoId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    fetch(`/foto/${fotoId}/comment`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const messageDiv = document.getElementById('commentMessage');
            messageDiv.innerHTML = `
                <div class="p-4 rounded-lg" style="background-color: rgba(0, 194, 168, 0.1); border-left: 4px solid #00C2A8;">
                    <p style="color: #00C2A8; font-weight: 600;">${data.message}</p>
                </div>
            `;
            form.reset();
            
            setTimeout(() => {
                messageDiv.innerHTML = '';
            }, 5000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const messageDiv = document.getElementById('commentMessage');
        messageDiv.innerHTML = `
            <div class="p-4 rounded-lg" style="background-color: rgba(239, 68, 68, 0.1); border-left: 4px solid #EF4444;">
                <p style="color: #EF4444; font-weight: 600;">Terjadi kesalahan. Silakan coba lagi.</p>
            </div>
        `;
    });
}

// Load comments
function loadComments(fotoId) {
    fetch(`/foto/${fotoId}/comments`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById('commentsContainer');
            
            if (data.comments.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                `;
            } else {
                container.innerHTML = data.comments.map(comment => `
                    <div class="p-6 rounded-lg" style="background-color: #F5EFFF;">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);">
                                <span class="text-white font-bold text-lg">${comment.name.charAt(0).toUpperCase()}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-bold" style="color: #1C1C2E;">${comment.name}</h4>
                                    <span class="text-sm text-gray-500">${new Date(comment.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</span>
                                </div>
                                <p class="text-gray-700">${comment.comment}</p>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
            
            document.getElementById('commentsCount').textContent = data.comments.length;
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
