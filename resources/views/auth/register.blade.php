<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-navy-dark tracking-tight">Daftar Akun</h2>
        <p class="text-gray-500 mt-2">Buat akun baru untuk mulai mencatat daftar film impian Anda.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider mb-2">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="Nama Lengkap">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider mb-2">Password</label>
            <input type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-navy-dark text-white rounded-xl font-bold shadow-lg hover:bg-black hover:translate-y-[-2px] transition-all duration-200 uppercase tracking-widest">
                BUAT AKUN SEKARANG
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-8">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-gold-brown font-bold hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>