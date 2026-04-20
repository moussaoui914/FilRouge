@extends('layouts.app')

@section('title', $habitat->name . ' - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            @if($habitat->image)
                <div class="h-96 bg-cover bg-center" style="background-image: url('{{ Storage::url($habitat->image) }}')"></div>
            @else
                <div class="h-96 bg-gradient-to-r from-zoo-700 to-zoo-900 flex items-center justify-center">
                    <span class="text-9xl">🏞️</span>
                </div>
            @endif
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $habitat->name }}</h1>
                <p class="text-xl text-zoo-600 mb-4">{{ $habitat->type }} Habitat</p>
                <p class="text-gray-600 mb-6">{{ $habitat->description ?? 'No description available.' }}</p>
                <div class="flex space-x-4">
                    <span>📍 {{ $habitat->location ?? 'Location TBD' }}</span>
                    <span>📊 Capacity: {{ $habitat->capacity }} animals</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">Animals in this Habitat</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                @forelse($habitat->animals as $animal)
                <div class="border rounded-lg p-4">
                    <h3 class="font-bold">{{ $animal->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $animal->species }}</p>
                    <a href="{{ route('animals.public.show', $animal) }}" class="text-zoo-600 text-sm mt-2 inline-block">View Details →</a>
                </div>
                @empty
                <p class="text-gray-500 col-span-3">No animals in this habitat yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection