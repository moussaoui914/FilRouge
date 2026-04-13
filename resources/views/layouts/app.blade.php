<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'ZooQuarium — Zoo Management System')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body:    ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        zoo: {
                            50:  '#f0fdf4',
                            100: '#dcfce7',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>

    @stack('styles')
</head>
<body class="bg-stone-50 text-stone-800 antialiased">

    {{-- ─── Navbar ─────────────────────────────────────────────────────────── --}}
    <nav x-data="{ open: false }" class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-2xl">🦁</span>
                    <span class="font-display font-bold text-xl text-zoo-800 group-hover:text-zoo-600 transition-colors">
                        ZooQuarium
                    </span>
                </a>

                {{-- Desktop Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"    class="text-sm font-medium text-stone-600 hover:text-zoo-700 transition-colors">Home</a>
                    <a href="#animals"              class="text-sm font-medium text-stone-600 hover:text-zoo-700 transition-colors">Animals</a>
                    <a href="#habitats"             class="text-sm font-medium text-stone-600 hover:text-zoo-700 transition-colors">Habitats</a>
                    <a href="#tickets"              class="text-sm font-medium text-stone-600 hover:text-zoo-700 transition-colors">Tickets</a>
                </div>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="text-sm font-medium text-zoo-700 hover:text-zoo-900">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-sm font-medium bg-stone-100 hover:bg-stone-200 px-4 py-2 rounded-lg transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-stone-600 hover:text-zoo-700 transition-colors px-4 py-2">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="text-sm font-semibold bg-zoo-700 hover:bg-zoo-800 text-white px-5 py-2 rounded-lg transition-colors shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>

                {{-- Mobile Toggle --}}
                <button @click="open = !open" class="md:hidden p-2 rounded-lg hover:bg-stone-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="md:hidden bg-white border-t border-stone-100 px-4 py-4 space-y-2">
            <a href="{{ route('home') }}"   class="block py-2 text-stone-700 font-medium">Home</a>
            <a href="#animals"              class="block py-2 text-stone-700 font-medium">Animals</a>
            <a href="#habitats"             class="block py-2 text-stone-700 font-medium">Habitats</a>
            <a href="#tickets"              class="block py-2 text-stone-700 font-medium">Tickets</a>
            <hr class="border-stone-200 my-2">
            @guest
                <a href="{{ route('login') }}"    class="block py-2 text-stone-700 font-medium">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-zoo-700 font-semibold">Register</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-stone-700 font-medium">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
             class="fixed top-20 right-4 z-50 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <span>✅</span>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 z-50 bg-red-50 border border-red-200 text-red-800 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <span>❌</span>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="pt-16">
        @yield('content')
    </main>

    {{-- ─── Footer ──────────────────────────────────────────────────────────── --}}
    <footer class="bg-zoo-900 text-white mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-2xl">🦁</span>
                    <span class="font-display font-bold text-xl">ZooQuarium</span>
                </div>
                <p class="text-zoo-100/70 text-sm leading-relaxed">
                    A comprehensive zoo management system for modern wildlife sanctuaries.
                </p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-zoo-100">Contact</h4>
                <ul class="space-y-2 text-sm text-zoo-100/70">
                    <li>📧 contact@zooquarium.com</li>
                    <li>📞 +1 (555) 123-4567</li>
                    <li>📍 123 Wildlife Ave, Nature City</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-zoo-100">Follow Us</h4>
                <div class="flex gap-4">
                    <a href="#" class="text-zoo-100/60 hover:text-white transition-colors text-sm">Twitter</a>
                    <a href="#" class="text-zoo-100/60 hover:text-white transition-colors text-sm">Facebook</a>
                    <a href="#" class="text-zoo-100/60 hover:text-white transition-colors text-sm">Instagram</a>
                </div>
            </div>
        </div>
        <div class="border-t border-zoo-800 py-5 text-center text-xs text-zoo-100/40">
            &copy; {{ date('Y') }} ZooQuarium — All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>