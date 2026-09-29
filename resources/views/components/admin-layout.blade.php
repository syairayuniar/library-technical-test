<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Admin' }} - Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="flex min-h-screen">
        <aside class="w-56 bg-indigo-900 text-white flex flex-col">
            <div class="p-4 text-lg font-medium">Perpustakaan</div>
            <nav class="flex-1 px-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-indigo-800">Dashboard</a>
                <a href="{{ route('admin.books.index') }}" class="block px-3 py-2 rounded hover:bg-indigo-800">Kelola Buku</a>
                <a href="{{ route('admin.borrowings.index') }}" class="block px-3 py-2 rounded hover:bg-indigo-800">Transaksi</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="p-4">
                @csrf
                <button class="text-sm text-indigo-200 hover:text-white">Logout</button>
            </form>
        </aside>
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
        <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
            {{ $slot }}
        </main>
    </div>
</body>
</html> 