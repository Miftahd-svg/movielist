<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MovieWatch') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex w-1/2 bg-navy-dark items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=2070')] bg-cover"></div>
            <div class="relative z-10 text-center p-12">
                <h1 class="text-5xl font-bold text-white mb-4 italic font-serif">Cinema Journey.</h1>
                <p class="text-gold-brown text-xl tracking-widest uppercase">Tracked by You.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-10 lg:hidden text-center">
                    <span class="text-3xl font-bold text-navy-dark italic">Movie<span class="text-gold-brown">Watch</span></span>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>