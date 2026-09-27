<x-admin-layout title="Edit Buku">
    <h1 class="text-xl font-medium mb-4">Edit Buku</h1>
    <form method="POST" action="{{ route('admin.books.update', $book) }}">
        @method('PUT')
        @include('admin.books._form')
    </form>
</x-admin-layout>