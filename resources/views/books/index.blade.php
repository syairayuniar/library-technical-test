<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                    Perpustakaan
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
                    Katalog Buku
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Pilih buku yang ingin Anda baca dan pinjam.
                </p>
            </div>

            <!-- Live Search Bar Minimalis Modern -->
            <div class="relative w-full sm:w-80">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" id="live-book-search" placeholder="Cari judul atau penulis..." 
                       class="w-full pl-9 pr-4 py-2 bg-white/80 backdrop-blur-sm border border-zinc-200/80 rounded-xl text-sm placeholder-zinc-400 text-zinc-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Grid Card Buku Gaya Glass -->
            <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="book-card group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white/75 p-5 backdrop-blur-md border border-white/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-0.5 hover:border-zinc-300/60 transition-all duration-300">
                        
                        <!-- Top Glow Ambient -->
                        <div class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-indigo-100/30 blur-xl group-hover:bg-indigo-200/40 transition-all"></div>

                        <div>
                            <!-- Header Card: Category & Stock Pill -->
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="inline-block truncate max-w-[120px] text-[11px] font-medium tracking-tight px-2.5 py-0.5 rounded-full bg-zinc-100 text-zinc-600 border border-zinc-200/60">
                                    {{-- PERBAIKAN DI SINI: panggil ->name jika itu objek relasi --}}
                                    {{ is_object($book->category) ? $book->category->name : ($book->category ?? 'Umum') }}
                                </span>

                                @if($book->stock > 0)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50/80 border border-emerald-200/60 px-2 py-0.5 rounded-full">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Tersedia: {{ $book->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-rose-600 bg-rose-50/80 border border-rose-200/60 px-2 py-0.5 rounded-full">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Title & Author Typography -->
                            <h3 class="book-title text-base font-semibold tracking-tight text-zinc-900 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="book-author text-xs text-zinc-500 mt-1">
                                Oleh <span class="text-zinc-700 font-medium">{{ $book->author }}</span>
                            </p>
                        </div>

                        <!-- Footer: Info & Action Form -->
                        <div class="mt-5 pt-3 border-t border-zinc-100/80 flex items-center justify-between">
                            <span class="text-[11px] text-zinc-400">
                                {{ $book->year ? 'Thn: ' . $book->year : 'Umum' }}
                            </span>
                            
                            @if($book->stock > 0)
                                <form action="{{ route('borrowings.store', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center px-3.5 py-1.5 bg-zinc-900 hover:bg-indigo-600 text-white rounded-lg text-xs font-medium tracking-tight shadow-sm hover:shadow transition-all duration-200 active:scale-95">
                                        Pinjam
                                    </button>
                                </form>
                            @else
                                <button disabled class="px-3 py-1.5 bg-zinc-100 text-zinc-400 rounded-lg text-xs font-medium cursor-not-allowed">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-400 mb-3">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-zinc-600">Belum ada koleksi buku yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- State pencarian kosong -->
            <div id="no-search-results" class="hidden py-16 text-center text-zinc-400 text-sm">
                Tidak ada buku yang sesuai dengan kata kunci pencarian.
            </div>

        </div>
    </div>

    <!-- Script Live Search JS Tetap Berjalan -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('live-book-search');
            const bookCards = document.querySelectorAll('.book-card');
            const noResults = document.getElementById('no-search-results');

            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const query = e.target.value.toLowerCase().trim();
                    let visibleCount = 0;

                    bookCards.forEach(card => {
                        const title = card.querySelector('.book-title')?.textContent.toLowerCase() || '';
                        const author = card.querySelector('.book-author')?.textContent.toLowerCase() || '';

                        if (title.includes(query) || author.includes(query)) {
                            card.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    if (visibleCount === 0 && bookCards.length > 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</x-app-layout>