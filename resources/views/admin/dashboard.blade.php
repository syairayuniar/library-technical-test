<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                    Panel Administrator
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
                    Dashboard
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Ringkasan statistik sirkulasi dan koleksi buku perpustakaan
                </p>
            </div>

            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.books.create') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Buku
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="rounded-2xl bg-white/85 backdrop-blur-md border border-white/80 p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Total Buku</span>
                    <h2 class="text-3xl font-extrabold text-zinc-900 mt-2">
                        {{ \App\Models\Book::count() }}
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">Judul koleksi buku terdaftar</p>
                </div>

                
                <div class="rounded-2xl bg-white/85 backdrop-blur-md border border-white/80 p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Total Stok</span>
                    <h2 class="text-3xl font-extrabold text-zinc-900 mt-2">
                        {{ \App\Models\Book::sum('stock') }}
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">Total eksemplar fisik di rak</p>
                </div>

                
                <div class="rounded-2xl bg-white/85 backdrop-blur-md border border-white/80 p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Peminjaman Aktif</span>
                    <h2 class="text-3xl font-extrabold text-zinc-900 mt-2">
                        {{ \App\Models\Borrowing::whereNull('returned_at')->count() }}
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">Buku yang sedang dipinjam anggota</p>
                </div>
            </div>

            
            <div class="rounded-2xl bg-white/85 backdrop-blur-md border border-white/80 p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-sm font-semibold text-zinc-900 mb-4">Navigasi Operasional</h3>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('admin.books.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-zinc-200/80 bg-white hover:bg-zinc-50 text-xs font-semibold text-zinc-700 shadow-sm transition-all duration-150">
                        📖 Kelola Koleksi Buku &rarr;
                    </a>
                    <a href="{{ route('admin.borrowings.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-zinc-200/80 bg-white hover:bg-zinc-50 text-xs font-semibold text-zinc-700 shadow-sm transition-all duration-150">
                        📋 Lihat Log Transaksi &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>