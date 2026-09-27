<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Perpustakaan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
    <nav class="bg-white shadow-sm px-6 py-3 flex justify-between items-center">
        <span class="font-medium text-indigo-900">Perpustakaan</span>
        <div class="space-x-4 text-sm">
            <a href="{{ route('books.index') }}" class="hover:text-indigo-600">Daftar Buku</a>
            <a href="{{ route('borrowings.index') }}" class="hover:text-indigo-600">Peminjaman Saya</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-slate-500 hover:text-red-600">Logout</button>
            </form>
        </div>
    </nav>
    <main class="p-6 max-w-5xl mx-auto">
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>