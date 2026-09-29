<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                    Sirkulasi Perpustakaan
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
                    Log Transaksi Peminjaman
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Riwayat dan pemantauan status peminjaman buku oleh seluruh anggota
                </p>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-white/80 border border-zinc-200/80 text-zinc-700 shadow-sm backdrop-blur-sm">
                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                    Total: {{ $borrowings->total() }} Transaksi
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white/85 backdrop-blur-md border border-white/80 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-zinc-200/70 bg-zinc-50/60 text-[11px] font-semibold uppercase tracking-wider text-zinc-400">
                                <th scope="col" class="py-4 px-6">Buku</th>
                                <th scope="col" class="py-4 px-6">Peminjam</th>
                                <th scope="col" class="py-4 px-6">Tgl Pinjam</th>
                                <th scope="col" class="py-4 px-6">Tgl Kembali</th>
                                <th scope="col" class="py-4 px-6 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-sm">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-zinc-50/50 transition-colors duration-150">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-zinc-900">
                                                    {{ $borrowing->book->title ?? 'Buku Dihapus' }}
                                                </p>
                                                <p class="text-xs text-zinc-400 mt-0.5">
                                                    Penulis: {{ $borrowing->book->author ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 whitespace-nowrap">
    <div>
        <p class="font-medium text-zinc-800 text-xs">
            {{ $borrowing->user->name ?? 'User Tidak Diketahui' }}
        </p>
        <p class="text-[11px] text-zinc-400">
            {{ $borrowing->user->email ?? '-' }}
        </p>
    </div>
</td>

                                   
                                    <td class="py-4 px-6 text-zinc-600 font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($borrowing->borrowed_at ?? $borrowing->created_at)->translatedFormat('d M Y') }}
                                    </td>

                                    
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        @if($borrowing->returned_at)
                                            <span class="text-zinc-600 font-medium">
                                                {{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d M Y') }}
                                            </span>
                                        @else
                                            <span class="text-zinc-400 font-medium">-</span>
                                        @endif
                                    </td>

                                    
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($borrowing->returned_at)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/70">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Dikembalikan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/70">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Dipinjam
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-zinc-400 text-sm">
                                        Belum ada riwayat transaksi peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($borrowings->hasPages())
                    <div class="p-4 border-t border-zinc-100/80 bg-zinc-50/30">
                        {{ $borrowings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>