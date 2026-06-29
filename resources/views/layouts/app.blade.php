<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Deteksi Risiko PCOS')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-tr from-pink-50 to-rose-100 min-h-screen text-slate-800">
    <div class="main-layout min-h-screen flex flex-col justify-between">
        
        <!-- Navigation Header -->
        <nav class="navbar-custom shadow-sm bg-white/80 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="navbar-brand-custom">
                            <i class="fa-solid fa-microscope text-rose-500 text-2xl"></i>
                            <span class="text-rose-600 font-bold ml-2">PCOSAI</span>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="nav-link-custom {{ Request::is('/') ? 'text-rose-600 font-semibold' : 'text-slate-500 hover:text-rose-500' }}">Beranda</a>
                        <a href="{{ route('deteksi.form') }}" class="nav-link-custom {{ Request::is('deteksi') ? 'text-rose-600 font-semibold' : 'text-slate-500 hover:text-rose-500' }}">Deteksi PCOS</a>
                    </div>
                    
                    <!-- Mobile Menu Button (Optional, can be hidden for simplicity) -->
                    <div class="flex items-center md:hidden">
                        <a href="{{ route('deteksi.form') }}" class="btn-rose-custom text-sm py-1.5 px-4">
                            Deteksi
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <main class="content-wrapper flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-8 pb-12">
            
            <!-- Success/Error Banner -->
            @if (session('success'))
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl shadow-sm animate-fade-in">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-triangle-exclamation text-rose-500 text-xl"></i>
                        <h4 class="font-bold text-sm">Terjadi Kesalahan:</h4>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white text-slate-500 py-8 border-t border-rose-100 flex-shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left sm:flex sm:justify-between sm:items-center">
                <div>
                    <h3 class="text-rose-600 font-bold text-lg flex items-center justify-center sm:justify-start gap-2 mb-2">
                        <i class="fa-solid fa-microscope text-rose-500"></i> PCOSAI
                    </h3>
                    <p class="text-xs max-w-md text-slate-400">
                        Aplikasi deteksi dini risiko PCOS menggunakan model Deep Learning. 
                        Hasil deteksi adalah informasi skrining awal dan bukan diagnosis medis klinis.
                    </p>
                </div>
                <div class="mt-6 sm:mt-0 text-xs text-slate-400">
                    <p>&copy; 2026 PCOSAI. Hak Cipta Dilindungi.</p>
                    <p class="mt-1">Dibuat dengan rasa peduli kesehatan wanita.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
