<x-app-layout title="Peminjaman Saya">
    <h1 class="text-xl font-medium mb-4">Peminjaman Saya</h1>
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-100 text-sm text-slate-600">
                <tr><th class="p-3">Buku</th><th class="p-3">Tgl Pinjam</th><th class="p-3">Tgl Kembali</th><th class="p-3">Status</th><th class="p-3">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse ($borrowings as $borrowing)
                <tr class="border-t">
                    <td class="p-3">{{ $borrowing->book->title }}</td>
                    <td class="p-3">{{ $borrowing->borrowed_at->format('d M Y') }}</td>
                    <td class="p-3">{{ $borrowing->returned_at?->format('d M Y') ?? '-' }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs {{ $borrowing->status === 'dipinjam' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </td>
                    <td class="p-3">
                        @if (!$borrowing->returned_at)
                            <form method="POST" action="{{ route('borrowings.return', $borrowing) }}">
                                @csrf @method('PUT')
                                <button class="text-indigo-600 text-sm">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-3 text-slate-500">Belum ada peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $borrowings->links() }}</div>
</x-app-layout>