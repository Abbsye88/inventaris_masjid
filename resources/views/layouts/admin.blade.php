<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris Masjid')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <aside class="w-64 bg-emerald-700 text-white flex flex-col flex-shrink-0">
            <div class="p-6 border-b border-emerald-600">
                <h1 class="text-lg font-bold flex items-center gap-2">
                    🕌 <span>Inventaris Masjid</span>
                </h1>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600' : '' }}">
                    <span>🏠</span> Dashboard
                </a>
                <a href="{{ route('admin.inventaris.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition {{ request()->routeIs('admin.inventaris.*') ? 'bg-emerald-600' : '' }}">
                    <span>📦</span> Inventaris
                </a>
                <a href="{{ route('admin.kategori.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition {{ request()->routeIs('admin.kategori.*') ? 'bg-emerald-600' : '' }}">
                    <span>🏷️</span> Kategori
                </a>
                <a href="{{ route('admin.lokasi.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition {{ request()->routeIs('admin.lokasi.*') ? 'bg-emerald-600' : '' }}">
                    <span>📍</span> Lokasi
                </a>
                <a href="{{ route('admin.peminjaman.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition {{ request()->routeIs('admin.peminjaman.*') ? 'bg-emerald-600' : '' }}">
                    <span>📤</span> Peminjaman
                </a>
            </nav>
            <div class="p-4 border-t border-emerald-600">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-emerald-600 transition">
                        <span>🚪</span> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name ?? 'Guest' }}</span>
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-semibold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                    </div>
                </div>
            </header>
            <div class="p-8">
                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                        <ul class="list-disc ml-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>