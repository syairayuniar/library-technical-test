<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Halo, {{ auth()->user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Jika User adalah Admin: Tampilkan 1 card khusus --}}
            @if(auth()->user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="block bg-indigo-50 border border-indigo-100 rounded-xl shadow-sm p-6 hover:shadow-md hover:bg-indigo-100/70 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="inline-block text-xs font-semibold px-2.5 py-1 bg-indigo-600 text-white rounded-md mb-2">
                                    Panel Pengelola
                                </span>
                                <h3 class="text-lg font-bold text-indigo-900">
                                    Buka Dashboard Admin →
                                </h3>
                                <p class="text-sm text-slate-600 mt-1">
                                    Kelola buku, data anggota, dan pantau seluruh transaksi peminjaman.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

            {{-- Jika Peminjam/User biasa: Tampilkan 3 card navigasi --}}
            @else
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('books.index') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-100">
                        <p class="text-sm text-slate-500">Katalog</p>
                        <p class="font-medium text-indigo-700 text-lg mt-1">Lihat & Cari Buku →</p>
                    </a>

                    <a href="{{ route('borrowings.index') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-100">
                        <p class="text-sm text-slate-500">Peminjaman Saya</p>
                        <p class="font-medium text-indigo-700 text-lg mt-1">
                            {{ auth()->user()->borrowings()->whereNull('returned_at')->count() }} sedang dipinjam →
                        </p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-100">
                        <p class="text-sm text-slate-500">Akun</p>
                        <p class="font-medium text-indigo-700 text-lg mt-1">Edit Profil →</p>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>