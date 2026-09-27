<x-admin-layout title="Dashboard">
    <h1 class="text-xl font-medium mb-4">Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Total Buku</p><p class="text-2xl font-medium">{{ \App\Models\Book::count() }}</p></div>
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Total Stok</p><p class="text-2xl font-medium">{{ \App\Models\Book::sum('stock') }}</p></div>
        <div class="bg-white rounded-xl shadow-sm p-4"><p class="text-sm text-slate-500">Peminjaman Aktif</p><p class="text-2xl font-medium">{{ \App\Models\Borrowing::whereNull('returned_at')->count() }}</p></div>
    </div>
</x-admin-layout>