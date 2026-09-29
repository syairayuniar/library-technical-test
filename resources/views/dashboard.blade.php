<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Halo, {{ auth()->user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('books.index') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                <p class="text-sm text-slate-500">Buku</p>
                <p class="font-medium text-indigo-700">Lihat & Cari Buku →</p>
            </a>
            <a href="{{ route('borrowings.index') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                <p class="text-sm text-slate-500">Peminjaman Saya</p>
                <p class="font-medium text-indigo-700">
                    {{ auth()->user()->borrowings()->whereNull('returned_at')->count() }} sedang dipinjam →
                </p>
            </a>
            <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                <p class="text-sm text-slate-500">Akun</p>
                <p class="font-medium text-indigo-700">Edit Profil →</p>
            </a>
        </div>
    </div>
</x-app-layout>