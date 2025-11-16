<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Galeri Sekolah' }} - Edufr4me</title>
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        /* Apply Poppins Font */
        * {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom Color Palette */
        :root {
            --primary: #6155F5;
            --light-bg: #F5EFFF;
            --teal: #00C2A8;
            --yellow: #FFC857;
            --dark: #1C1C2E;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Futuristic Gradient Background */
        .bg-futuristic {
            background: linear-gradient(135deg, #6155F5 0%, #7B6FF7 25%, #5B9FD4 50%, #4DBFB8 75%, #00C2A8 100%);
        }

        /* Glass Morphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Navbar Styles */
        #navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Hover Effects */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #6155F5;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Button Glow Effect */
        .btn-glow {
            box-shadow: 0 0 20px rgba(97, 85, 245, 0.5);
            transition: all 0.3s ease;
        }

        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(97, 85, 245, 0.8);
            transform: scale(1.05);
        }
    </style>
</head>
<body style="background-color: #F5EFFF;">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Edufr4me Logo" class="h-12 w-auto">
                        <span class="text-xl font-bold text-gray-800">Eduframe</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link font-medium {{ request()->routeIs('home') ? 'active' : '' }}" style="color: #1C1C2E;" onmouseover="this.style.color='#6155F5'" onmouseout="this.style.color='#1C1C2E'">
                        Dashboard
                    </a>
                    <a href="{{ route('info') }}" class="nav-link font-medium {{ request()->routeIs('info') ? 'active' : '' }}" style="color: #1C1C2E;" onmouseover="this.style.color='#6155F5'" onmouseout="this.style.color='#1C1C2E'">
                        About School
                    </a>
                    <a href="{{ route('galeri') }}" class="nav-link font-medium {{ request()->routeIs('galeri') ? 'active' : '' }}" style="color: #1C1C2E;" onmouseover="this.style.color='#6155F5'" onmouseout="this.style.color='#1C1C2E'">
                        School Gallery
                    </a>
                    <a href="{{ route('guest.berita') }}" class="nav-link font-medium {{ request()->routeIs('guest.berita*') ? 'active' : '' }}" style="color: #1C1C2E;" onmouseover="this.style.color='#6155F5'" onmouseout="this.style.color='#1C1C2E'">
                        Berita
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('home') ? 'text-white' : '' }}" style="{{ request()->routeIs('home') ? 'background-color: #6155F5; color: white;' : 'color: #1C1C2E;' }}" onmouseover="if(!this.classList.contains('text-white')) {this.style.backgroundColor='#6155F5'; this.style.color='white';}" onmouseout="if(!this.classList.contains('text-white')) {this.style.backgroundColor='transparent'; this.style.color='#1C1C2E';}">
                    Dashboard
                </a>
                <a href="{{ route('info') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('info') ? 'text-white' : '' }}" style="{{ request()->routeIs('info') ? 'background-color: #6155F5; color: white;' : 'color: #1C1C2E;' }}" onmouseover="if(!this.classList.contains('text-white')) {this.style.backgroundColor='#6155F5'; this.style.color='white';}" onmouseout="if(!this.classList.contains('text-white')) {this.style.backgroundColor='transparent'; this.style.color='#1C1C2E';}">
                    About School
                </a>
                <a href="{{ route('galeri') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('galeri') ? 'text-white' : '' }}" style="{{ request()->routeIs('galeri') ? 'background-color: #6155F5; color: white;' : 'color: #1C1C2E;' }}" onmouseover="if(!this.classList.contains('text-white')) {this.style.backgroundColor='#6155F5'; this.style.color='white';}" onmouseout="if(!this.classList.contains('text-white')) {this.style.backgroundColor='transparent'; this.style.color='#1C1C2E';}">
                    School Gallery
                </a>
                <a href="{{ route('guest.berita') }}" class="block px-4 py-3 hover:bg-gray-50 transition {{ request()->routeIs('guest.berita*') ? 'bg-gray-50 font-semibold' : '' }}" style="color: #1C1C2E;">
                    Berita
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white mt-20 relative overflow-hidden" style="background: linear-gradient(180deg, #1C1C2E 0%, #2a2a4a 100%);">
        <!-- Decorative gradient overlay -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full blur-3xl" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full blur-3xl" style="background: linear-gradient(135deg, #FFC857 0%, #6155F5 100%);"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                
                <!-- About Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Edufr4me Logo" class="h-12 w-auto">
                            <span class="text-xl font-bold text-white">Eduframe</span>
                        </a>
                    </div>
                    <p class="text-gray-400 leading-relaxed text-sm">
                        Platform galeri digital sekolah yang modern dan futuristik untuk mendokumentasikan setiap momen berharga dalam perjalanan pendidikan.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #FFC857;">Menu Cepat</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-gray-400 hover:text-white transition group">
                                <svg class="w-4 h-4" style="color: #6155F5;" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                <span class="group-hover:translate-x-1 transition">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('info') }}" class="flex items-center space-x-2 text-gray-400 hover:text-white transition group">
                                <svg class="w-4 h-4" style="color: #6155F5;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="group-hover:translate-x-1 transition">About School</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('galeri') }}" class="flex items-center space-x-2 text-gray-400 hover:text-white transition group">
                                <svg class="w-4 h-4" style="color: #6155F5;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="group-hover:translate-x-1 transition">School Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('agenda') }}" class="flex items-center space-x-2 text-gray-400 hover:text-white transition group">
                                <svg class="w-4 h-4" style="color: #6155F5;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="group-hover:translate-x-1 transition">Agenda</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #FFC857;">Hubungi Kami</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start space-x-3 text-gray-400">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #00C2A8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <a href="https://www.google.com/maps/place/SMKN+4+Bogor/@-6.6407334,106.822119,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69c8b16ee07ef5:0x14ab253dd267de49!8m2!3d-6.6407334!4d106.8246939!16s%2Fg%2F1hm2r8zh4?entry=ttu" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">
                                KP. Buntar, Kelurahan Muarasari<br>Kecamatan Bogor Selatan, Kota Bogor<br>Provinsi Jawa Barat
                            </a>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-400">
                            <svg class="w-5 h-5 flex-shrink-0" style="color: #00C2A8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:is.novadigital@gmail.com" class="hover:text-white transition">is.novadigital@gmail.com</a>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-400">
                            <svg class="w-5 h-5 flex-shrink-0" style="color: #00C2A8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:+62895386313752" class="hover:text-white transition">+62 895 3863 13752</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t" style="border-color: rgba(255, 255, 255, 0.1);">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} <span style="color: #FFC857; font-weight: 600;">Edufr4me</span>. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                        <span class="text-gray-600">•</span>
                        <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                        <span class="text-gray-600">•</span>
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Admin Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
