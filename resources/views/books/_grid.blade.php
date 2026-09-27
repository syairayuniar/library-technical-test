<div id="book-grid" class="grid grid-cols-3 gap-4">
    @forelse ($books as $book)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <p class="text-xs text-indigo-600 mb-1">{{ $book->category->name }}</p>
            <h3 class="font-medium mb-1">{{ $book->title }}</h3>
            <p class="text-sm text-slate-500 mb-3">{{ $book->author }}</p>
            <div class="flex justify-between items-center">
                <span class="px-2 py-1 rounded-full text-xs {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    Stok: {{ $book->stock }}
                </span>
                <form method="POST" action="{{ route('borrowings.store', $book) }}">
                    @csrf
                    <button {{ $book->stock < 1 ? 'disabled' : '' }}
                        class="px-3 py-1.5 rounded-lg text-sm {{ $book->stock < 1 ? 'bg-slate-200 text-slate-400' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}">
                        {{ $book->stock < 1 ? 'Habis' : 'Pinjam' }}
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="col-span-3 text-slate-500">Buku tidak ditemukan.</p>
    @endforelse
</div>