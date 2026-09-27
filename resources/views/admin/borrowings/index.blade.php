<x-admin-layout title="Transaksi Peminjaman">
    <h1 class="text-xl font-medium mb-4">Transaksi Peminjaman</h1>
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-100 text-sm text-slate-600">
                <tr><th class="p-3">Peminjam</th><th class="p-3">Buku</th><th class="p-3">Tgl Pinjam</th><th class="p-3">Status</th></tr>
            </thead>
            <tbody>
            @forelse ($borrowings as $borrowing)
                <tr class="border-t">
                    <td class="p-3">{{ $borrowing->user->name }}</td>
                    <td class="p-3">{{ $borrowing->book->title }}</td>
                    <td class="p-3">{{ $borrowing->borrowed_at->format('d M Y') }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs {{ $borrowing->status === 'dipinjam' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-3 text-slate-500">Belum ada transaksi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $borrowings->links() }}</div>
</x-admin-layout>