<x-app-layout title="Daftar Buku">
    <h1 class="text-xl font-medium mb-4">Daftar Buku</h1>
    <input type="text" id="search-input" placeholder="Cari judul atau penulis..."
        class="w-full border rounded-lg px-3 py-2 mb-4">
    @include('books._grid')
</x-app-layout>

@vite('resources/js/book-search.js')