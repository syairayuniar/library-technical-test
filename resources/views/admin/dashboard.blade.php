<x-admin-layout title="Dashboard">
    <h1 class="text-xl font-medium mb-4">Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Total Buku</p><p class="text-2xl font-medium">{{ \App\Models\Book::count() }}</p></div>
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Total Stok</p><p class="text-2xl font-medium">{{ \App\Models\Book::sum('stock') }}</p></div>
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Peminjaman Aktif</p><p class="text-2xl font-medium">{{ \App\Models\Borrowing::whereNull('returned_at')->count() }}</p></div>
    </div>
    <div class="mt-6 flex flex-wrap gap-3">
    <a href="{{ route('admin.books.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium">
        + Tambah Buku
    </a>
    <a href="{{ route('admin.books.index') }}" class="text-indigo-600 self-center hover:underline text-sm font-medium">
        Kelola Buku
    </a>
    <a href="{{ route('admin.borrowings.index') }}" class="text-indigo-600 self-center hover:underline text-sm font-medium">
        Lihat Transaksi
    </a>
</div>
</x-admin-layout>