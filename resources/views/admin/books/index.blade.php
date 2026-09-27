<x-admin-layout title="Kelola Buku">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-medium">Kelola Buku</h1>
        <a href="{{ route('admin.books.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Tambah Buku</a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..."
            class="border rounded-lg px-3 py-2 w-64">
    </form>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-100 text-sm text-slate-600">
                <tr><th class="p-3">Judul</th><th class="p-3">Penulis</th><th class="p-3">Kategori</th><th class="p-3">Stok</th><th class="p-3">Aksi</th></tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr class="border-t">
                    <td class="p-3">{{ $book->title }}</td>
                    <td class="p-3">{{ $book->author }}</td>
                    <td class="p-3">{{ $book->category->name }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600">Edit</a>
                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline" onsubmit="return confirm('Yakin hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $books->links() }}</div>
</x-admin-layout>