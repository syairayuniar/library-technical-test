<x-admin-layout title="Tambah Buku">
    <h1 class="text-xl font-medium mb-4">Tambah Buku</h1>
    <form method="POST" action="{{ route('admin.books.store') }}">
        @include('admin.books._form', ['book' => null])
    </form>
</x-admin-layout>