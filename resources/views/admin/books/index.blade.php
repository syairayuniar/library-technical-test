<x-app-layout>
    <x-slot name="header">
        <x-page-header subtitle="Manajemen Katalog" title="Kelola Buku" description="Daftar inventaris dan kontrol stok buku">
            <x-slot name="action">
                <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm">
                    + Tambah Buku
                </a>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <x-card class="p-0 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-zinc-200/70 bg-zinc-50/60 text-[11px] font-semibold uppercase tracking-wider text-zinc-400">
                                <th class="py-4 px-6">Judul</th>
                                <th class="py-4 px-6">Penulis</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6 text-center">Stok</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-sm">
                            @forelse($books as $book)
                                <tr class="hover:bg-zinc-50/50">
                                    <td class="py-4 px-6 font-semibold text-zinc-900">{{ $book->title }}</td>
                                    <td class="py-4 px-6 text-zinc-600">{{ $book->author }}</td>
                                    <td class="py-4 px-6 text-zinc-600">{{ $book->category->name ?? '-' }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $book->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-3">
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Edit</a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Hapus buku ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800 cursor-pointer">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-zinc-400 text-sm">Belum ada data buku.</td>
                                </tr>
                            @endforelse
                   

@if(session('error'))
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
        {{ session('error') }}
    </div>
@endif
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>