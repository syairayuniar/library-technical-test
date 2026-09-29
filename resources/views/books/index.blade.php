<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                    Perpustakaan
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
                    Koleksi Buku
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Explore buku sesuai preferensi Anda
                </p>
            </div>

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
            
            <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="book-card group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white/80 p-6 backdrop-blur-md border border-white shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-0.5 hover:border-slate-300 transition-all duration-300">
                        
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="inline-block truncate max-w-[120px] text-[11px] font-medium px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200/80">
                                    {{ is_object($book->category) ? $book->category->name : ($book->category ?? 'Umum') }}
                                </span>

                                @if($book->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Tersedia: {{ $book->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-rose-600 bg-rose-50 border border-rose-200/80 px-2.5 py-1 rounded-full">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <h3 class="book-title text-base font-semibold tracking-tight text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="book-author text-xs text-slate-500 mt-1.5">
                                Oleh <span class="text-slate-700 font-medium">{{ $book->author }}</span>
                            </p>
                        </div>

                        <div class="mt-7 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                            <span class="text-xs font-medium text-slate-400">
                                {{ $book->year ? 'Thn: ' . $book->year : 'Umum' }}
                            </span>
                            
                            @if($book->stock > 0)
                                <form action="{{ route('borrowings.store', $book) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white rounded-xl text-xs font-semibold shadow-sm transition-all duration-150 cursor-pointer">
                                        Pinjam Buku
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-3.5 py-2 bg-slate-100 text-slate-400 rounded-xl text-xs font-medium cursor-not-allowed">
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 text-sm">
                        Belum ada koleksi buku yang tersedia.
                    </div>
                @endforelse
            </div>

            
            <div id="no-search-results" class="hidden py-16 text-center text-slate-400 text-sm">
                Tidak ada buku yang sesuai dengan kata kunci pencarian.
            </div>

        </div>
    </div>

    
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