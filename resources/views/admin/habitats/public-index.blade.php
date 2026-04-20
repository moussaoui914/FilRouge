@extends('layouts.app')

@section('title', 'Our Habitats - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Explore Our Habitats</h1>
            <p class="text-gray-600 text-lg">Discover different ecosystems from around the world</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($habitats as $habitat)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                @if($habitat->image)
                    <img src="{{ Storage::url($habitat->image) }}" alt="{{ $habitat->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gradient-to-r from-zoo-100 to-zoo-200 flex items-center justify-center">
                        <span class="text-8xl">🏞️</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $habitat->name }}</h3>
                    <p class="text-zoo-600 mb-3">{{ $habitat->type }} Habitat</p>
                    <p class="text-gray-600 mb-4">{{ Str::limit($habitat->description, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">🐾 {{ $habitat->animals_count }} animals</span>
                        <a href="{{ route('habitats.public.show', $habitat) }}" class="text-zoo-600 font-semibold hover:text-zoo-800">Explore →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $habitats->links() }}
        </div>
    </div>
</div>
@endsection