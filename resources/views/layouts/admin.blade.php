<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') — ZooQuarium</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-link.active { @apply bg-emerald-700 text-white; }
    </style>
</head>
<body class="bg-stone-100 antialiased" x-data="{ sidebarOpen: true }">

<div class="flex h-screen overflow-hidden">

    {{-- ─── Sidebar ───────────────────────────────────────────────────────── --}}
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
           class="flex-shrink-0 bg-zoo-900 text-white transition-all duration-300 flex flex-col overflow-hidden">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-4 h-16 border-b border-zoo-800">
            <span class="text-2xl flex-shrink-0">🦁</span>
            <span x-show="sidebarOpen" x-transition.opacity
                  class="font-display font-bold text-lg whitespace-nowrap">ZooQuarium</span>
        </div>

        {{-- Nav Items --}}
        <nav class="flex-1 py-6 px-2 space-y-1 overflow-y-auto">
            @php
                $links = [
                    ['route' => 'admin.dashboard',       'icon' => '📊', 'label' => 'Dashboard'],
                    ['route' => 'admin.animals.index',   'icon' => '🐘', 'label' => 'Animals'],
                    ['route' => 'admin.dashboard',       'icon' => '🌿', 'label' => 'Habitats'],
                    ['route' => 'admin.dashboard',       'icon' => '🩺', 'label' => 'Medical Records'],
                    ['route' => 'admin.dashboard',       'icon' => '🎟️', 'label' => 'Tickets'],
                    ['route' => 'admin.dashboard',       'icon' => '👥', 'label' => 'Users'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-zoo-100/80 hover:bg-zoo-700 hover:text-white transition-colors
                          {{ request()->routeIs($link['route']) ? 'bg-zoo-700 text-white' : '' }}">
                    <span class="text-lg flex-shrink-0">{{ $link['icon'] }}</span>
                    <span x-show="sidebarOpen" x-transition.opacity class="text-sm font-medium whitespace-nowrap">
                        {{ $link['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>

        {{-- User Info --}}
        <div x-show="sidebarOpen" class="px-4 py-4 border-t border-zoo-800">
            <p class="text-xs text-zoo-100/50 mb-1">Signed in as</p>
            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="text-xs text-zoo-100/60 hover:text-white transition-colors">
                    Logout →
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── Main Content ───────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-white border-b border-stone-200 h-16 flex items-center justify-between px-6 flex-shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg hover:bg-stone-100 transition-colors text-stone-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="font-semibold text-stone-800 text-lg">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm text-stone-500">{{ now()->format('D, M d Y') }}</span>
                <div class="w-8 h-8 bg-zoo-700 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 x-transition class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 x-transition class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <span>❌</span> {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>

{{-- ─── CSS Variables ───────────────────────────────────────────────────────── --}}
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    zoo: {
                        50: '#f0fdf4', 100: '#dcfce7',
                        600: '#16a34a', 700: '#15803d',
                        800: '#166534', 900: '#14532d',
                    }
                },
                fontFamily: {
                    display: ['"Playfair Display"', 'serif'],
                    body:    ['"DM Sans"', 'sans-serif'],
                }
            }
        }
    }
</script>