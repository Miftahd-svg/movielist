<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-navy-dark tracking-tight uppercase">
                {{ __('My Watchlist') }}
            </h2>
            <div class="text-[10px] font-black text-gold-brown uppercase tracking-[0.2em] bg-gold-brown/5 px-4 py-2 rounded-full border border-gold-brown/10">
                {{ now()->format('D, d M Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FDFDFC] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-navy-dark rounded-[2rem] p-10 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 select-none pointer-events-none">
                    <span class="text-[12rem] leading-none">📽️</span>
                </div>
                <div class="relative z-10">
                    <h3 class="text-4xl font-bold mb-3 tracking-tight italic">
                        Halo, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gold-brown font-bold tracking-[0.3em] uppercase text-xs">
                        Curate Your Personal Cinema Collection
                    </p>
                </div>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- FORM -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 sticky top-8">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-1.5 h-8 bg-gold-brown rounded-full"></div>
                            <h4 class="text-lg font-black text-navy-dark uppercase tracking-widest text-sm">
                                Add Movie
                            </h4>
                        </div>

                        <form action="{{ route('movies.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 block">
                                    Movie Title
                                </label>
                                <input type="text" name="title" required
                                    class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:border-gold-brown focus:ring-gold-brown transition-all"
                                    placeholder="e.g. Inception">
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 block">
                                    Category
                                </label>
                                <select name="genre" required
                                    class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:border-gold-brown focus:ring-gold-brown transition-all">
                                    <option value="Action">Action</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Sci-Fi">Sci-Fi</option>
                                    <option value="Horror">Horror</option>
                                    <option value="Comedy">Comedy</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full py-5 bg-navy-dark text-white rounded-2xl font-black text-xs tracking-[0.2em] shadow-xl hover:bg-black hover:-translate-y-1 transition-all uppercase">
                                Save to List
                            </button>
                        </form>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">

                        <div class="p-8 border-b border-gray-50 bg-white flex justify-between items-center">
                            <h4 class="text-sm font-black text-navy-dark uppercase tracking-[0.2em] italic underline decoration-gold-brown decoration-4 underline-offset-8">
                                Recent Watchlist
                            </h4>
                            {{-- Shortcut ke halaman reviews --}}
                            <a href="{{ route('reviews.index') }}"
                               class="text-[10px] font-black text-gold-brown uppercase tracking-[0.15em] hover:underline">
                                ✍️ My Reviews →
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-10 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                            Movie Details
                                        </th>
                                        <th class="px-10 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">
                                            Status
                                        </th>
                                        <th class="px-10 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-50">
                                    @forelse($movies ?? [] as $movie)
                                    <tr x-data="{ editing: false }" class="group hover:bg-gray-50/80 transition-all">

                                        <td class="px-10 py-7">
                                            <template x-if="!editing">
                                                <div>
                                                    <div class="font-extrabold text-navy-dark text-lg">
                                                        {{ $movie->title }}
                                                    </div>
                                                    <div class="text-[10px] font-bold text-gray-400 uppercase">
                                                        {{ $movie->genre }}
                                                    </div>
                                                </div>
                                            </template>

                                            <template x-if="editing">
                                                <form id="edit-form-{{ $movie->id }}"
                                                    action="{{ route('movies.update', $movie) }}"
                                                    method="POST" class="space-y-2">
                                                    @csrf @method('PATCH')
                                                    <input type="text" name="title" value="{{ $movie->title }}"
                                                        class="w-full text-sm p-2 rounded-lg border-gray-200">
                                                    <select name="genre"
                                                        class="w-full text-[10px] p-2 rounded-lg border-gray-200 uppercase font-bold">
                                                        <option value="Action" {{ $movie->genre == 'Action' ? 'selected' : '' }}>Action</option>
                                                        <option value="Drama" {{ $movie->genre == 'Drama' ? 'selected' : '' }}>Drama</option>
                                                        <option value="Sci-Fi" {{ $movie->genre == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                                                        <option value="Horror" {{ $movie->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
                                                        <option value="Comedy" {{ $movie->genre == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                                                    </select>
                                                </form>
                                            </template>
                                        </td>

                                        <td class="px-10 py-7 text-center">
                                            {{-- ✅ Tampilkan status 'sudah' = Finished, selain itu = Belum --}}
                                            <span class="px-5 py-2 rounded-full text-[9px] font-black uppercase
                                                {{ $movie->status === 'sudah' ? 'bg-green-100 text-green-700' : 'bg-gold-brown/10 text-gold-brown' }}">
                                                {{ $movie->status === 'sudah' ? 'Finished ✅' : 'Belum' }}
                                            </span>
                                        </td>

                                        <td class="px-10 py-7 text-right">
                                            <div x-show="!editing" class="flex justify-end gap-4 items-center">
                                                <button @click="editing = true"
                                                    class="text-xs font-black text-navy-dark hover:text-gold-brown transition">
                                                    Edit
                                                </button>

                                                {{-- ✅ Toggle status: kirim field 'toggle_status' = true --}}
                                                <form action="{{ route('movies.update', $movie) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="toggle_status" value="1">
                                                    <button type="submit"
                                                        class="text-xs font-black {{ $movie->status === 'sudah' ? 'text-green-600' : 'text-gray-400' }} hover:text-gold-brown transition">
                                                        {{ $movie->status === 'sudah' ? 'Unmark' : 'Mark Done' }}
                                                    </button>
                                                </form>

                                                {{-- Jika sudah ditonton, tampilkan link ke review --}}
                                                @if($movie->status === 'sudah')
                                                    <a href="{{ route('reviews.index') }}"
                                                       class="text-xs font-black text-gold-brown hover:underline">
                                                        ✍️ Review
                                                    </a>
                                                @endif

                                                <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                                    onsubmit="return confirm('Hapus?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-xs text-red-400 font-black hover:text-red-600 transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>

                                            <div x-show="editing" class="flex justify-end gap-2">
                                                <button form="edit-form-{{ $movie->id }}" type="submit"
                                                    class="text-green-600 text-xs font-black">Save</button>
                                                <button @click="editing = false"
                                                    class="text-gray-400 text-xs font-black">Cancel</button>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3"
                                            class="px-10 py-24 text-center text-[10px] font-black text-gray-400 uppercase">
                                            No movies found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>