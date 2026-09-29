<x-app-layout>
    <x-slot name="header">
        <x-page-header subtitle="Manajemen Katalog" title="Tambah Buku Baru" description="Masukkan detail informasi buku baru ke database">
            <x-slot name="action">
                <a href="{{ route('admin.books.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-zinc-600 bg-white border border-zinc-200 shadow-sm">
                    &larr; Kembali
                </a>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card>
                <form action="{{ route('admin.books.store') }}" method="POST">
                    @csrf
                    @include('admin.books._form', ['buttonText' => 'Simpan Buku', 'book' => null])
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>