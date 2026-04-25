<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-navy-dark tracking-tight uppercase">
                {{ __('My Reviews') }}
            </h2>
            <div class="text-[10px] font-black text-gold-brown uppercase tracking-[0.2em] bg-gold-brown/5 px-4 py-2 rounded-full border border-gold-brown/10">
                {{ now()->format('D, d M Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FDFDFC] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Hero Banner --}}
            <div class="bg-navy-dark rounded-[2rem] p-10 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 select-none pointer-events-none">
                    <span class="text-[12rem] leading-none">⭐</span>
                </div>
                <div class="relative z-10">
                    <h3 class="text-4xl font-bold mb-3 tracking-tight italic">
                        Your Critiques, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gold-brown font-bold tracking-[0.3em] uppercase text-xs">
                        Rate & Review Your Watched Films
                    </p>
                </div>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl text-sm font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- FORM ADD REVIEW --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 sticky top-8">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-1.5 h-8 bg-gold-brown rounded-full"></div>
                            <h4 class="text-lg font-black text-navy-dark uppercase tracking-widest text-sm">
                                Add Review
                            </h4>
                        </div>

                        @if($watchedMovies->isEmpty())
                            <div class="text-center py-8">
                                <div class="text-4xl mb-3">🎬</div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.15em]">
                                    No watched movies yet.
                                </p>
                                <p class="text-[10px] text-gray-400 mt-1">
                                    Mark a movie as finished from the dashboard first.
                                </p>
                                <a href="{{ route('dashboard') }}"
                                   class="inline-block mt-5 px-5 py-3 bg-navy-dark text-white rounded-2xl font-black text-[10px] tracking-[0.15em] uppercase hover:bg-black transition">
                                    Go to Dashboard
                                </a>
                            </div>
                        @else
                            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 block">
                                        Select Movie
                                    </label>
                                    <select name="movie_id" required
                                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:border-gold-brown focus:ring-gold-brown transition-all text-sm">
                                        <option value="" disabled selected>-- Choose a film --</option>
                                        @foreach($watchedMovies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 block">
                                        Rating (1–5 ⭐)
                                    </label>
                                    <select name="rating" required
                                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:border-gold-brown focus:ring-gold-brown transition-all text-sm">
                                        <option value="" disabled selected>-- Choose rating --</option>
                                        <option value="5">⭐⭐⭐⭐⭐ — Masterpiece</option>
                                        <option value="4">⭐⭐⭐⭐ — Great</option>
                                        <option value="3">⭐⭐⭐ — Good</option>
                                        <option value="2">⭐⭐ — Mediocre</option>
                                        <option value="1">⭐ — Poor</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 block">
                                        Your Review (optional)
                                    </label>
                                    <textarea name="review_text" rows="4" maxlength="1000"
                                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:border-gold-brown focus:ring-gold-brown transition-all text-sm resize-none"
                                        placeholder="What did you think?"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full py-5 bg-navy-dark text-white rounded-2xl font-black text-xs tracking-[0.2em] shadow-xl hover:bg-black hover:-translate-y-1 transition-all uppercase">
                                    Save Review
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- TABLE REVIEWS --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">

                        <div class="p-8 border-b border-gray-50 bg-white">
                            <h4 class="text-sm font-black text-navy-dark uppercase tracking-[0.2em] italic underline decoration-gold-brown decoration-4 underline-offset-8">
                                My Reviews
                            </h4>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                            Movie
                                        </th>
                                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">
                                            Rating
                                        </th>
                                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                            Review
                                        </th>
                                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-50">
                                    @forelse($reviews as $review)
                                    <tr x-data="{ editing: false }" class="group hover:bg-gray-50/80 transition-all">

                                        {{-- Movie Title --}}
                                        <td class="px-8 py-7">
                                            <div class="font-extrabold text-navy-dark text-base">
                                                {{ $review->movie->title ?? '—' }}
                                            </div>
                                            <div class="text-[10px] font-bold text-gray-400 uppercase">
                                                {{ $review->movie->genre ?? '' }}
                                            </div>
                                        </td>

                                        {{-- Rating --}}
                                        <td class="px-8 py-7 text-center">
                                            <template x-if="!editing">
                                                <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full bg-gold-brown/10 text-gold-brown text-xs font-black">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        {{ $i <= $review->rating ? '⭐' : '☆' }}
                                                    @endfor
                                                </span>
                                            </template>
                                            <template x-if="editing">
                                                {{-- rating field in the edit form below --}}
                                                <span class="text-[10px] text-gray-400 font-bold uppercase">See form →</span>
                                            </template>
                                        </td>

                                        {{-- Review Text --}}
                                        <td class="px-8 py-7 max-w-xs">
                                            <template x-if="!editing">
                                                <p class="text-sm text-gray-600 line-clamp-2">
                                                    {{ $review->review_text ?: '—' }}
                                                </p>
                                            </template>

                                            <template x-if="editing">
                                                <form id="edit-review-{{ $review->id }}"
                                                      action="{{ route('reviews.update', $review) }}"
                                                      method="POST" class="space-y-2">
                                                    @csrf @method('PUT')
                                                    <select name="rating" required
                                                        class="w-full text-xs p-2 rounded-lg border-gray-200">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                                                {{ str_repeat('⭐', $i) }} ({{ $i }})
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <textarea name="review_text" rows="3" maxlength="1000"
                                                        class="w-full text-xs p-2 rounded-lg border-gray-200 resize-none"
                                                        placeholder="Edit review...">{{ $review->review_text }}</textarea>
                                                </form>
                                            </template>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-8 py-7 text-right whitespace-nowrap">
                                            <div x-show="!editing" class="flex justify-end gap-4">
                                                <button @click="editing = true"
                                                    class="text-xs font-black text-navy-dark hover:text-gold-brown transition">
                                                    Edit
                                                </button>
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                                      onsubmit="return confirm('Delete this review?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-xs font-black text-red-400 hover:text-red-600 transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>

                                            <div x-show="editing" class="flex justify-end gap-3">
                                                <button form="edit-review-{{ $review->id }}" type="submit"
                                                    class="text-green-600 text-xs font-black hover:text-green-800 transition">
                                                    Save
                                                </button>
                                                <button @click="editing = false"
                                                    class="text-gray-400 text-xs font-black hover:text-gray-600 transition">
                                                    Cancel
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-10 py-24 text-center text-[10px] font-black text-gray-400 uppercase">
                                            No reviews yet — watch a film and share your thoughts!
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