@extends('layouts.app')

@section('page-title', 'Kelola Komentar')
@section('page-subtitle', 'Moderasi komentar dari pengunjung')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold" style="color: #1C1C2E;">Total Komentar</h3>
                <p class="text-3xl font-bold" style="color: #6155F5;">{{ $comments->total() }}</p>
            </div>
        </div>
    </div>

    <div class="max-w-full">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="mb-6 bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex border-b">
                    <a href="{{ route('admin.comments.index') }}" class="px-6 py-4 text-sm font-semibold transition {{ !request('status') ? 'bg-gradient-to-r from-purple-600 to-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                        Semua Komentar
                    </a>
                    <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="px-6 py-4 text-sm font-semibold transition {{ request('status') == 'pending' ? 'bg-gradient-to-r from-purple-600 to-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                        Menunggu Persetujuan
                        @php
                            $pendingCount = \App\Models\FotoComment::where('is_approved', false)->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="ml-2 px-2 py-1 text-xs bg-red-500 text-white rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="px-6 py-4 text-sm font-semibold transition {{ request('status') == 'approved' ? 'bg-gradient-to-r from-purple-600 to-teal-500 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                        Disetujui
                    </a>
                </div>
            </div>

            <!-- Comments List -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($comments->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($comments as $comment)
                            <div class="p-6 hover:bg-gray-50 transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <!-- Comment Header -->
                                        <div class="flex items-center space-x-3 mb-3">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);">
                                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-900">{{ $comment->name }}</h3>
                                                <div class="flex items-center space-x-3 text-sm text-gray-500">
                                                    @if($comment->email)
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                            </svg>
                                                            {{ $comment->email }}
                                                        </span>
                                                    @endif
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        {{ $comment->created_at->format('d M Y, H:i') }}
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                        </svg>
                                                        {{ $comment->ip_address }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Content -->
                                        <div class="mb-3 p-4 bg-gray-50 rounded-lg">
                                            <p class="text-gray-700">{{ $comment->comment }}</p>
                                        </div>

                                        <!-- Foto Info -->
                                        @if($comment->foto)
                                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                                <img src="{{ $comment->foto->path }}" alt="{{ $comment->foto->judul }}" class="w-16 h-16 object-cover rounded-lg">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900">{{ $comment->foto->judul }}</p>
                                                    <a href="{{ route('galeri.detail', $comment->foto->id) }}" target="_blank" class="text-xs text-purple-600 hover:text-purple-800">
                                                        Lihat Foto →
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="ml-6 flex flex-col space-y-2">
                                        <!-- Status Badge -->
                                        @if($comment->is_approved)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Pending
                                            </span>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col space-y-2">
                                            @if(!$comment->is_approved)
                                                <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition flex items-center justify-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Setujui
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.comments.unapprove', $comment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-700 transition flex items-center justify-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition flex items-center justify-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-gray-50 border-t">
                        {{ $comments->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Komentar</h3>
                        <p class="text-gray-500">Komentar dari pengunjung akan muncul di sini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
