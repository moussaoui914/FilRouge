@extends('layouts.app')

@section('title', 'Our Animals - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Amazing Animals</h1>
            <p class="text-gray-600 text-lg">Discover incredible creatures from around the world</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($animals as $animal)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                @if($animal->image)
                    <img src="{{ Storage::url($animal->image) }}" alt="{{ $animal->name }}" class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                @else
                    <div class="w-full h-64 bg-gradient-to-r from-zoo-100 to-zoo-200 flex items-center justify-center">
                        <span class="text-7xl">🦁</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $animal->name }}</h3>
                    <p class="text-zoo-600 font-semibold mb-3">{{ $animal->species }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">📍 {{ $animal->habitat->name ?? 'Unknown' }}</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-{{ $animal->health_badge_color }}-100 text-{{ $animal->health_badge_color }}-800">
                            {{ $animal->health_status }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($animal->description, 100) }}</p>
                    <a href="{{ route('animals.public.show', $animal) }}" class="inline-flex items-center text-zoo-600 font-semibold hover:text-zoo-800">
                        Learn More →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $animals->links() }}
        </div>
    </div>
</div>
@endsection