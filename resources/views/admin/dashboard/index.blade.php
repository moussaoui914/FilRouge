@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ─── STATS CARDS ─────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    @php
        $cards = [
            [
                'label'  => 'Total Animals',
                'value'  => $stats['animals'],
                'icon'   => '🐘',
                'color'  => 'bg-emerald-50 border-emerald-100',
                'text'   => 'text-emerald-700',
                'badge'  => 'bg-emerald-100 text-emerald-700',
                'route'  => 'admin.animals.index',
                'link'   => 'View all animals',
            ],
            [
                'label'  => 'Habitats',
                'value'  => $stats['habitats'],
                'icon'   => '🌿',
                'color'  => 'bg-sky-50 border-sky-100',
                'text'   => 'text-sky-700',
                'badge'  => 'bg-sky-100 text-sky-700',
                'route'  => 'admin.dashboard',
                'link'   => 'View habitats',
            ],
            [
                'label'  => 'Total Users',
                'value'  => $stats['users'],
                'icon'   => '👥',
                'color'  => 'bg-violet-50 border-violet-100',
                'text'   => 'text-violet-700',
                'badge'  => 'bg-violet-100 text-violet-700',
                'route'  => 'admin.dashboard',
                'link'   => 'View users',
            ],
            [
                'label'  => 'Critical Health',
                'value'  => $stats['critical'],
                'icon'   => '🚨',
                'color'  => 'bg-red-50 border-red-100',
                'text'   => 'text-red-700',
                'badge'  => 'bg-red-100 text-red-700',
                'route'  => 'admin.animals.index',
                'link'   => 'View animals',
            ],
        ];
    @endphp

    @foreach($cards as $card)
        <div class="bg-white border {{ $card['color'] }} rounded-2xl p-5 flex flex-col gap-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-stone-500">{{ $card['label'] }}</span>
                <span class="w-10 h-10 rounded-xl {{ $card['badge'] }} flex items-center justify-center text-xl">
                    {{ $card['icon'] }}
                </span>
            </div>
            <div class="flex items-end justify-between">
                <span class="font-display text-4xl font-bold {{ $card['text'] }}">
                    {{ $card['value'] }}
                </span>
                <a href="{{ route($card['route']) }}"
                   class="text-xs font-medium text-stone-400 hover:{{ $card['text'] }} transition-colors">
                    {{ $card['link'] }} →
                </a>
            </div>
        </div>
    @endforeach

</div>

{{-- ─── MAIN GRID ───────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Recent Animals Table --}}
    <div class="xl:col-span-2 bg-white rounded-2xl border border-stone-200 overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-stone-100">
            <div>
                <h2 class="font-semibold text-stone-800">Recent Animals</h2>
                <p class="text-xs text-stone-400 mt-0.5">Last 5 animals added</p>
            </div>
            <a href="{{ route('admin.animals.index') }}"
               class="text-xs font-semibold text-zoo-700 hover:text-zoo-900 bg-zoo-50 hover:bg-zoo-100 px-3 py-1.5 rounded-lg transition-colors">
                View all
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-stone-50 text-left">
                        <th class="px-6 py-3 text-xs font-semibold text-stone-500 uppercase tracking-wide">Animal</th>
                        <th class="px-6 py-3 text-xs font-semibold text-stone-500 uppercase tracking-wide">Species</th>
                        <th class="px-6 py-3 text-xs font-semibold text-stone-500 uppercase tracking-wide">Habitat</th>
                        <th class="px-6 py-3 text-xs font-semibold text-stone-500 uppercase tracking-wide">Health</th>
                        <th class="px-6 py-3 text-xs font-semibold text-stone-500 uppercase tracking-wide"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($recentAnimals as $animal)
                        <tr class="hover:bg-stone-50 transition-colors">

                            {{-- Animal name + image --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($animal->image)
                                        <img src="{{ asset('storage/' . $animal->image) }}"
                                             alt="{{ $animal->name }}"
                                             class="w-9 h-9 rounded-xl object-cover flex-shrink-0"/>
                                    @else
                                        <div class="w-9 h-9 rounded-xl bg-zoo-100 flex items-center justify-center text-lg flex-shrink-0">
                                            🐾
                                        </div>
                                    @endif
                                    <span class="font-medium text-stone-800">{{ $animal->name }}</span>
                                </div>
                            </td>

                            {{-- Species --}}
                            <td class="px-6 py-4 text-stone-500">{{ $animal->species }}</td>

                            {{-- Habitat --}}
                            <td class="px-6 py-4">
                                @if($animal->habitat)
                                    <span class="inline-flex items-center gap-1 bg-sky-50 text-sky-700 text-xs font-medium px-2.5 py-1 rounded-lg">
                                        🌿 {{ $animal->habitat->name }}
                                    </span>
                                @else
                                    <span class="text-stone-400 text-xs">— No habitat</span>
                                @endif
                            </td>

                            {{-- Health Status --}}
                            <td class="px-6 py-4">
                                @php
                                    $healthColors = [
                                        'Excellent' => 'bg-emerald-100 text-emerald-700',
                                        'Good'      => 'bg-green-100 text-green-700',
                                        'Fair'      => 'bg-yellow-100 text-yellow-700',
                                        'Poor'      => 'bg-orange-100 text-orange-700',
                                        'Critical'  => 'bg-red-100 text-red-700',
                                    ];
                                    $color = $healthColors[$animal->health_status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg {{ $color }}">
                                    {{ $animal->health_status }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.animals.edit', $animal) }}"
                                   class="text-xs text-stone-400 hover:text-zoo-700 font-medium transition-colors">
                                    Edit →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-400">
                                <div class="text-3xl mb-2">🐾</div>
                                <p class="text-sm">No animals found. <a href="{{ route('admin.animals.create') }}" class="text-zoo-700 font-medium">Add the first one</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ─── Side Panel ──────────────────────────────────────────────────────── --}}
    <div class="flex flex-col gap-5">

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-stone-200 p-5">
            <h2 class="font-semibold text-stone-800 mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.animals.create') }}"
                   class="flex items-center gap-3 w-full bg-zoo-50 hover:bg-zoo-100 text-zoo-800 font-medium text-sm px-4 py-3 rounded-xl transition-colors group">
                    <span class="text-lg">🐘</span>
                    <span>Add New Animal</span>
                    <span class="ml-auto text-zoo-400 group-hover:translate-x-0.5 transition-transform">→</span>
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 w-full bg-sky-50 hover:bg-sky-100 text-sky-800 font-medium text-sm px-4 py-3 rounded-xl transition-colors group">
                    <span class="text-lg">🌿</span>
                    <span>Add New Habitat</span>
                    <span class="ml-auto text-sky-400 group-hover:translate-x-0.5 transition-transform">→</span>
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 w-full bg-amber-50 hover:bg-amber-100 text-amber-800 font-medium text-sm px-4 py-3 rounded-xl transition-colors group">
                    <span class="text-lg">🎟️</span>
                    <span>Issue Ticket</span>
                    <span class="ml-auto text-amber-400 group-hover:translate-x-0.5 transition-transform">→</span>
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 w-full bg-violet-50 hover:bg-violet-100 text-violet-800 font-medium text-sm px-4 py-3 rounded-xl transition-colors group">
                    <span class="text-lg">🩺</span>
                    <span>Add Medical Record</span>
                    <span class="ml-auto text-violet-400 group-hover:translate-x-0.5 transition-transform">→</span>
                </a>
            </div>
        </div>

        {{-- Health Overview --}}
        <div class="bg-white rounded-2xl border border-stone-200 p-5">
            <h2 class="font-semibold text-stone-800 mb-4">Health Overview</h2>

            @php
                $healthData = \App\Models\Animal::selectRaw('health_status, count(*) as total')
                    ->groupBy('health_status')
                    ->pluck('total', 'health_status')
                    ->toArray();

                $allStatuses = ['Excellent', 'Good', 'Fair', 'Poor', 'Critical'];
                $total = array_sum($healthData) ?: 1;

                $barColors = [
                    'Excellent' => 'bg-emerald-500',
                    'Good'      => 'bg-green-400',
                    'Fair'      => 'bg-yellow-400',
                    'Poor'      => 'bg-orange-400',
                    'Critical'  => 'bg-red-500',
                ];
            @endphp

            <div class="space-y-3">
                @foreach($allStatuses as $status)
                    @php
                        $count   = $healthData[$status] ?? 0;
                        $percent = round(($count / $total) * 100);
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-stone-600 font-medium">{{ $status }}</span>
                            <span class="text-stone-400">{{ $count }} animals</span>
                        </div>
                        <div class="w-full bg-stone-100 rounded-full h-2">
                            <div class="{{ $barColors[$status] }} h-2 rounded-full transition-all duration-700"
                                 style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- System Info --}}
        <div class="bg-gradient-to-br from-zoo-800 to-zoo-900 rounded-2xl p-5 text-white">
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">🦁</span>
                <span class="font-semibold">ZooQuarium</span>
            </div>
            <p class="text-zoo-100/70 text-xs leading-relaxed mb-4">
                System running normally. All services operational.
            </p>
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="bg-white/10 rounded-xl px-3 py-2">
                    <div class="text-zoo-200/60 mb-0.5">Laravel</div>
                    <div class="font-semibold">v11</div>
                </div>
                <div class="bg-white/10 rounded-xl px-3 py-2">
                    <div class="text-zoo-200/60 mb-0.5">PHP</div>
                    <div class="font-semibold">v8.3</div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection