<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Edufr4me</title>
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .bg-gradient-custom {
            background: linear-gradient(135deg, #6155F5 0%, #7B6FF7 25%, #5B9FD4 50%, #4DBFB8 75%, #00C2A8 100%);
        }
        
        .login-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-custom min-h-screen flex items-center justify-center p-4">
    
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-block mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Edufr4me Logo" class="h-20 w-auto">
            </div>
            <h1 class="text-3xl font-bold text-white">Edufr4me</h1>
            <p class="text-white text-opacity-80">Admin Panel</p>
        </div>
        
        <!-- Login Card -->
        <div class="login-card rounded-3xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Edufr4me Logo" class="h-16 w-auto mx-auto">
                </div>
                <h2 class="text-2xl font-bold" style="color: #1C1C2E;">Login Administrator</h2>
                <p class="text-gray-600 mt-2">Masuk ke dashboard admin untuk mengelola website</p>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Email Admin
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5" style="color: #6155F5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="w-full pl-12 pr-4 py-3 rounded-lg border-2 transition focus:outline-none @error('email') border-red-500 @else border-gray-300 @enderror"
                            style="@error('email') border-color: #EF4444; @else border-color: rgba(97, 85, 245, 0.2); @enderror"
                            onfocus="this.style.borderColor='#6155F5'" 
                            onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                            placeholder="admin@example.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2" style="color: #1C1C2E;">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5" style="color: #6155F5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full pl-12 pr-4 py-3 rounded-lg border-2 transition focus:outline-none @error('password') border-red-500 @else border-gray-300 @enderror"
                            style="@error('password') border-color: #EF4444; @else border-color: rgba(97, 85, 245, 0.2); @enderror"
                            onfocus="this.style.borderColor='#6155F5'" 
                            onblur="this.style.borderColor='rgba(97, 85, 245, 0.2)'"
                            placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-2 transition" style="border-color: #6155F5; color: #6155F5;">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold transition" style="color: #6155F5;" onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'">
                            Lupa password?
                        </a>
                    @endif
                </div>
                
                <!-- Login Button -->
                <button type="submit" class="w-full py-3 rounded-lg font-bold text-white shadow-lg transition" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 20px 40px rgba(97, 85, 245, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(97, 85, 245, 0.3)'">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Masuk ke Dashboard
                </button>
            </form>
            
            <!-- Back to Website -->
            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold transition" style="color: #6155F5;" onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Website
                </a>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8 text-white text-opacity-80 text-sm">
            <p>&copy; {{ date('Y') }} Edufr4me. All rights reserved.</p>
        </div>
    </div>
    
</body>
</html>
