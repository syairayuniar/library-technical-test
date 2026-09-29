<div class="space-y-5">
    <div>
        <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-zinc-700 mb-2">Judul Buku *</label>
        <input type="text" name="title" id="title" value="{{ old('title', $book->title ?? '') }}" required
               class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm"
               placeholder="Contoh: Laskar Pelangi">
        @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="author" class="block text-xs font-semibold uppercase tracking-wider text-zinc-700 mb-2">Penulis *</label>
        <input type="text" name="author" id="author" value="{{ old('author', $book->author ?? '') }}" required
               class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm"
               placeholder="Contoh: Andrea Hirata">
        @error('author') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="category_id" class="block text-xs font-semibold uppercase tracking-wider text-zinc-700 mb-2">Kategori *</label>
            <select name="category_id" id="category_id" required
                    class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm">
                <option value="" disabled {{ empty($book->category_id) ? 'selected' : '' }}>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $book->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="stock" class="block text-xs font-semibold uppercase tracking-wider text-zinc-700 mb-2">Jumlah Stok *</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock ?? 0) }}" min="0" required
                   class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm">
            @error('stock') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="pt-5 border-t border-zinc-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.books.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-zinc-600 hover:bg-zinc-100">Batal</a>
        <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm cursor-pointer">
            {{ $buttonText ?? 'Simpan' }}
        </button>
    </div>
</div>