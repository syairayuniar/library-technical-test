@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm mb-1">Judul</label>
        <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Penulis</label>
        <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        @error('author') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Kategori</label>
        <select name="category_id" class="w-full border rounded-lg px-3 py-2">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Stok</label>
        <input type="number" name="stock" min="0" value="{{ old('stock', $book->stock ?? 0) }}" class="w-full border rounded-lg px-3 py-2">
        @error('stock') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan</button>
</div>