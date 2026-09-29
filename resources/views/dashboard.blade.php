<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">
                    Sistem Perpustakaan
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">
                    Halo, {{ auth()->user()->name }}
                </h1>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium bg-white/80 border border-zinc-200/80 text-zinc-600 shadow-sm backdrop-blur-sm">
                    <span class="h-1.5 w-1.5 rounded-full {{ auth()->user()->role === 'admin' ? 'bg-indigo-500' : 'bg-emerald-500' }}"></span>
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- VIEW JIKA LOGIN SEBAGAI ADMIN (1 KARTU SAJA) --}}
            @if(auth()->user()->role === 'admin')
                <div class="max-w-xl">
                    <x-dashboard-card 
                        :href="route('admin.dashboard')"
                        badge="Khusus Admin"
                        badgeColor="indigo"
                        title="Masuk ke Dashboard Admin"
                        description="Kelola inventaris koleksi buku, pantau mutasi transaksi peminjaman, dan operasional anggota perpustakaan."
                        actionText="Buka Panel Admin &rarr;">
                        
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </x-slot>
                    </x-dashboard-card>
                </div>

            {{-- VIEW JIKA LOGIN SEBAGAI PEMINJAM (3 KARTU) --}}
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Card 1: Katalog -->
                    <x-dashboard-card 
                        :href="route('books.index')"
                        badge="Katalog"
                        badgeColor="zinc"
                        title="Eksplorasi Koleksi Buku"
                        description="Jelajahi berbagai judul buku terbaru, cek sisa stok rak, dan ajukan peminjaman secara instan."
                        actionText="Buka Katalog &rarr;">
                        
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </x-slot>
                    </x-dashboard-card>

                    <!-- Card 2: Peminjaman Saya -->
                    <x-dashboard-card 
                        :href="route('borrowings.index')"
                        :badge="auth()->user()->borrowings()->whereNull('returned_at')->count() . ' Aktif'"
                        badgeColor="emerald"
                        title="Buku yang Dipinjam"
                        description="Pantau riwayat buku yang sedang Anda baca dan cek tenggat waktu agar tidak terlambat mengembalikan."
                        actionText="Lihat Peminjaman &rarr;">
                        
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </x-slot>
                    </x-dashboard-card>

                    <!-- Card 3: Profil -->
                    <x-dashboard-card 
                        :href="route('profile.edit')"
                        badge="Akun"
                        badgeColor="zinc"
                        title="Pengaturan Profil"
                        description="Kelola kredensial akun Anda, perbarui alamat surel, dan amankan akun dengan kata sandi baru."
                        actionText="Kelola Akun &rarr;">
                        
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </x-slot>
                    </x-dashboard-card>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>