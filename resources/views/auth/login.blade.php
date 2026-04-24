<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-navy-dark tracking-tight">Login</h2>
        <p class="text-gray-500 mt-2">Masuk untuk mengelola daftar tontonan film Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between mb-2">
                <label class="block text-sm font-bold text-navy-dark uppercase tracking-wider">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs text-gold-brown hover:underline">Lupa Password?</a>
            </div>
            <input type="password" name="password" required 
                class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-gold-brown focus:ring-gold-brown transition-all" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="w-full py-4 bg-navy-dark text-white rounded-xl font-bold shadow-lg hover:bg-black hover:translate-y-[-2px] transition-all duration-200">
            MASUK KE DASHBOARD
        </button>

        <p class="text-center text-sm text-gray-600 mt-8">
            Belum punya akun? <a href="{{ route('register') }}" class="text-gold-brown font-bold hover:underline">Daftar Sekarang</a>
        </p>
    </form>
</x-guest-layout>