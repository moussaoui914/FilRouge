@extends('layouts.app')

@section('title', 'ZooQuarium — Zoo Management System')

@section('content')

{{-- ─── HERO ──────────────────────────────────────────────────────────────── --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1534567153574-2b12153a87f0?w=1600&auto=format&fit=crop"
             alt="Zoo background"
             class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-br from-zoo-900/85 via-zoo-900/70 to-stone-900/80"></div>
    </div>

    {{-- Decorative circles --}}
    <div class="absolute top-32 right-16 w-64 h-64 bg-zoo-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-24 left-10 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full text-zoo-100 text-sm font-medium mb-8 border border-white/20">
            🌿 &nbsp; Welcome to ZooQuarium Management System
        </div>

        <h1 class="font-display font-black text-5xl sm:text-6xl lg:text-7xl text-white leading-tight mb-6">
            Zoo Management<br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-zoo-300 to-amber-300">
                System
            </span>
        </h1>

        <p class="text-zoo-100/80 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            A powerful platform to manage animals, habitats, veterinary care, and visitors —
            all in one streamlined dashboard.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#animals"
               class="inline-flex items-center gap-2 bg-zoo-600 hover:bg-zoo-500 text-white font-semibold px-8 py-4 rounded-xl transition-all shadow-lg shadow-zoo-900/30 hover:shadow-xl hover:-translate-y-0.5">
                🐘 Explore Animals
            </a>
            <a href="#tickets"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur text-white font-semibold px-8 py-4 rounded-xl border border-white/30 transition-all hover:-translate-y-0.5">
                🎟️ Buy Tickets
            </a>
        </div>

        {{-- Scroll hint --}}
        <div class="mt-16 animate-bounce">
            <svg class="w-6 h-6 text-white/40 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
</section>

{{-- ─── FEATURES ───────────────────────────────────────────────────────────── --}}
<section id="animals" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <span class="text-zoo-600 font-semibold text-sm uppercase tracking-widest">What We Offer</span>
            <h2 class="font-display text-4xl font-bold text-stone-900 mt-2">Powerful Features</h2>
            <p class="text-stone-500 mt-3 max-w-xl mx-auto">Everything you need to run a modern, well-organized zoo operation.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @php
                $features = [
                    [
                        'icon'  => '🐘',
                        'title' => 'Animal Management',
                        'desc'  => 'Track every animal — species, health status, birth dates, habitat assignments, and complete medical history with ease.',
                        'color' => 'from-emerald-50 to-green-50',
                        'badge' => 'text-emerald-700 bg-emerald-100',
                    ],
                    [
                        'icon'  => '🩺',
                        'title' => 'Veterinary Care',
                        'desc'  => 'Schedule check-ups, record treatments, manage medications, and monitor health trends across your entire animal population.',
                        'color' => 'from-blue-50 to-sky-50',
                        'badge' => 'text-blue-700 bg-blue-100',
                    ],
                    [
                        'icon'  => '🎟️',
                        'title' => 'Ticketing System',
                        'desc'  => 'Manage visitor tickets, track daily attendance, generate revenue reports, and control capacity effortlessly.',
                        'color' => 'from-amber-50 to-orange-50',
                        'badge' => 'text-amber-700 bg-amber-100',
                    ],
                ];
            @endphp

            @foreach($features as $f)
                <div class="group relative bg-gradient-to-br {{ $f['color'] }} border border-stone-200 rounded-2xl p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl {{ $f['badge'] }} text-2xl mb-6">
                        {{ $f['icon'] }}
                    </div>
                    <h3 class="font-display text-xl font-bold text-stone-900 mb-3">{{ $f['title'] }}</h3>
                    <p class="text-stone-600 leading-relaxed text-sm">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── STATISTICS ─────────────────────────────────────────────────────────── --}}
<section class="py-20 bg-zoo-900 relative overflow-hidden" id="habitats">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-zoo-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-amber-400 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-14">
            <span class="text-zoo-300 font-semibold text-sm uppercase tracking-widest">By The Numbers</span>
            <h2 class="font-display text-4xl font-bold text-white mt-2">Our Zoo At a Glance</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @php
                $stats_display = [
                    ['value' => number_format($stats['animals']),  'label' => 'Animals',       'icon' => '🐘', 'suffix' => '+'],
                    ['value' => number_format($stats['habitats']), 'label' => 'Habitats',      'icon' => '🌿', 'suffix' => ''],
                    ['value' => number_format($stats['visitors']), 'label' => 'Annual Visitors','icon' => '👥', 'suffix' => '+'],
                ];
            @endphp

            @foreach($stats_display as $s)
                <div class="text-center group">
                    <div class="text-4xl mb-4">{{ $s['icon'] }}</div>
                    <div class="font-display text-5xl font-black text-white mb-2">
                        {{ $s['value'] }}<span class="text-zoo-400">{{ $s['suffix'] }}</span>
                    </div>
                    <div class="text-zoo-200/70 font-medium">{{ $s['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── TICKETS CTA ─────────────────────────────────────────────────────────── --}}
<section id="tickets" class="py-24 bg-gradient-to-br from-amber-50 to-orange-50">
    <div class="max-w-4xl mx-auto text-center px-4">
        <span class="text-amber-600 font-semibold text-sm uppercase tracking-widest">Plan Your Visit</span>
        <h2 class="font-display text-4xl font-bold text-stone-900 mt-2 mb-4">Ready to Visit?</h2>
        <p class="text-stone-600 text-lg mb-10">Book your tickets online and enjoy a world-class wildlife experience for the whole family.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-10 py-4 rounded-xl transition-all shadow-lg shadow-amber-200">
                🎟️ Buy Tickets Now
            </a>
            <a href="#" class="bg-white border border-stone-200 hover:bg-stone-50 text-stone-800 font-semibold px-10 py-4 rounded-xl transition-all">
                Learn More
            </a>
        </div>
    </div>
</section>

@endsection