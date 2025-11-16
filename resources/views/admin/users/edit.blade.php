@extends('layouts.app')

@section('page-title', 'Edit Admin')
@section('page-subtitle', 'Update informasi administrator')

@section('content')
    <div class="max-w-2xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Admin
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 rounded-lg border-2 transition focus:outline-none @error('name') border-red-500 @else border-gray-300 @enderror"
                        style="@error('name') border-color: #EF4444; @else border-color: rgba(97, 85, 245, 0.2); @enderror"
                        onfocus="this.style.borderColor='#6155F5'" 
                        onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 rounded-lg border-2 transition focus:outline-none @error('email') border-red-500 @else border-gray-300 @enderror"
                        style="@error('email') border-color: #EF4444; @else border-color: rgba(97, 85, 245, 0.2); @enderror"
                        onfocus="this.style.borderColor='#6155F5'" 
                        onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                        placeholder="admin@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="mb-6 p-4 rounded-lg" style="background-color: rgba(97, 85, 245, 0.1); border-left: 4px solid #6155F5;">
                    <p class="text-sm" style="color: #6155F5;">
                        <strong>Info:</strong> Kosongkan field password jika tidak ingin mengubah password.
                    </p>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Password Baru (opsional)
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 rounded-lg border-2 transition focus:outline-none @error('password') border-red-500 @else border-gray-300 @enderror"
                        style="@error('password') border-color: #EF4444; @else border-color: rgba(97, 85, 245, 0.2); @enderror"
                        onfocus="this.style.borderColor='#6155F5'" 
                        onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-3 rounded-lg border-2 transition focus:outline-none"
                        style="border-color: rgba(97, 85, 245, 0.2);"
                        onfocus="this.style.borderColor='#6155F5'" 
                        onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                        placeholder="Ulangi password baru">
                </div>

                <!-- Buttons -->
                <div class="flex items-center space-x-4">
                    <button type="submit" class="px-8 py-3 rounded-lg font-bold text-white shadow-lg transition" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Admin
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
