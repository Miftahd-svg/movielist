<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Watchlist - Manage Your Cinema Journey</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-navy-dark { background-color: #0A192F; }
        .text-gold-brown { color: #996515; }
        .border-gold-brown { border-color: #996515; }
    </style>
</head>
<body class="bg-[#FDFDFC] antialiased font-sans">
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-gold-brown selection:text-white">
        
        <header class="absolute top-0 w-full p-6 flex justify-between items-center max-w-7xl">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🎬</span>
                <span class="font-bold text-xl text-navy-dark tracking-tight">Movie<span class="text-gold-brown">Watch</span></span>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-navy-dark hover:text-gold-brown transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-navy-dark hover:text-gold-brown transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-navy-dark text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition shadow-md">Get Started</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="text-center px-6">
            <div class="inline-block px-3 py-1 border border-gold-brown rounded-full text-[12px] font-bold text-gold-brown uppercase tracking-widest mb-6 animate-pulse">
                Personal Watchlist System
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-navy-dark mb-6 leading-tight">
                Track Every Movie <br>
                <span class="text-gold-brown italic font-serif">You've Ever Dreamed Of.</span>
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg mb-10 leading-relaxed">
                Kelola daftar tontonan film Anda dengan sistem yang elegan dan terorganisir. 
                Catat film yang sudah ditonton, beri rating, dan simpan daftar tontonan masa depan Anda di satu tempat.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-navy-dark text-white rounded-xl font-bold text-lg shadow-xl hover:translate-y-[-2px] transition-all">
                    Mulai Daftar Sekarang
                </a>
                <a href="#features" class="px-8 py-4 border-2 border-gray-200 text-navy-dark rounded-xl font-bold text-lg hover:bg-gray-50 transition-all">
                    Pelajari Fitur
                </a>
            </div>
        </main>

        <section id="features" class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl px-6 w-full">
            <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm">
                <div class="text-gold-brown text-3xl mb-4">🔒</div>
                <h3 class="font-bold text-navy-dark mb-2 text-lg">Secure & Private</h3>
                <p class="text-gray-500 text-sm">Hanya Anda yang dapat melihat dan mengelola daftar film pribadi Anda.</p>
            </div>
            <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm">
                <div class="text-gold-brown text-3xl mb-4">⚡</div>
                <h3 class="font-bold text-navy-dark mb-2 text-lg">Fast CRUD</h3>
                <p class="text-gray-500 text-sm">Tambah, update, dan hapus film dalam hitungan detik dengan interface yang intuitif.</p>
            </div>
            <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm border-b-4 border-gold-brown">
                <div class="text-gold-brown text-3xl mb-4">📱</div>
                <h3 class="font-bold text-navy-dark mb-2 text-lg">Cloud Sync</h3>
                <p class="text-gray-500 text-sm">Akses daftar film Anda di mana saja karena data tersimpan aman di cloud.</p>
            </div>
        </section>

        <footer class="mt-20 py-10 text-gray-400 text-sm">
            &copy; {{ date('Y') }} Movie Watchlist System. Built with Laravel 12 & Tailwind CSS.
        </footer>
    </div>
</body>
</html>