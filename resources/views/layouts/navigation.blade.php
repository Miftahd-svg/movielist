<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Left Side -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-black text-lg text-navy-dark tracking-widest">
                        WATCHLIST
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:ml-10">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-black uppercase tracking-widest
                              {{ request()->routeIs('dashboard') ? 'text-gold-brown border-b-2 border-gold-brown' : 'text-gray-700 hover:text-gold-brown' }} transition">
                        Dashboard
                    </a>
                    <a href="{{ route('reviews.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-black uppercase tracking-widest
                              {{ request()->routeIs('reviews.*') ? 'text-gold-brown border-b-2 border-gold-brown' : 'text-gray-700 hover:text-gold-brown' }} transition">
                        Reviews
                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-6">
                
                <!-- Watchlist Count -->
                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                    Movies: {{ count($movies ?? []) }}
                </div>

                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-black text-gray-700 hover:text-gold-brown transition">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 
                                            10.586l3.293-3.293a1 1 0 111.414 
                                            1.414l-4 4a1 1 0 01-1.414 
                                            0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block pl-3 pr-4 py-2 text-base font-black hover:bg-gray-50
                      {{ request()->routeIs('dashboard') ? 'text-gold-brown' : 'text-gray-700 hover:text-gold-brown' }}">
                Dashboard
            </a>
            <a href="{{ route('reviews.index') }}"
               class="block pl-3 pr-4 py-2 text-base font-black hover:bg-gray-50
                      {{ request()->routeIs('reviews.*') ? 'text-gold-brown' : 'text-gray-700 hover:text-gold-brown' }}">
                Reviews
            </a>
        </div>

        <!-- Responsive Settings -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-black text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-50">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-base text-gray-700 hover:bg-gray-50">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>