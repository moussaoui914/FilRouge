@extends('layouts.app')

@section('title', 'Our Animals - ZooQuarium')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Meet Our Amazing Animals</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Discover incredible creatures from around the world in their natural habitats</p>
        </div>

        <!-- Animals Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($animals as $animal)
            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <!-- Image Section -->
                <div class="relative h-64 overflow-hidden bg-gray-100">
                    @if($animal->image)
                        <img src="{{ Storage::url($animal->image) }}" alt="{{ $animal->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <svg class="w-20 h-20 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Health Status Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium shadow-sm
                            @if($animal->health_status == 'Excellent') bg-emerald-500 text-white
                            @elseif($animal->health_status == 'Good') bg-green-500 text-white
                            @elseif($animal->health_status == 'Fair') bg-yellow-500 text-white
                            @elseif($animal->health_status == 'Poor') bg-orange-500 text-white
                            @else bg-rose-500 text-white @endif">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($animal->health_status == 'Excellent' || $animal->health_status == 'Good')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @elseif($animal->health_status == 'Fair')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                @endif
                            </svg>
                            {{ $animal->health_status }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-5">
                    <div class="mb-3">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $animal->name }}</h3>
                        <p class="text-emerald-600 font-medium text-sm">{{ $animal->species }}</p>
                    </div>

                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center text-gray-500 text-xs">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $animal->habitat->name ?? 'Unknown Habitat' }}
                        </div>
                        @if($animal->age)
                        <div class="flex items-center text-gray-500 text-xs">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $animal->age }}
                        </div>
                        @endif
                    </div>

                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($animal->description, 100) ?: 'No description available for this animal.' }}
                    </p>

                    <a href="{{ route('animals.public.show', $animal) }}" 
                       class="inline-flex items-center text-emerald-600 font-medium hover:text-emerald-700 transition">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($animals->hasPages())
        <div class="mt-10">
            <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg shadow-sm">
                <div class="flex flex-1 justify-between sm:hidden">
                    @if($animals->onFirstPage())
                        <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400">Previous</span>
                    @else
                        <a href="{{ $animals->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                    @endif
                    @if($animals->hasMorePages())
                        <a href="{{ $animals->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                    @else
                        <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400">Next</span>
                    @endif
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ $animals->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $animals->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $animals->total() }}</span>
                            animals
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <a href="{{ $animals->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @foreach($animals->getUrlRange(1, $animals->lastPage()) as $page => $url)
                                @if($page == $animals->currentPage())
                                    <span class="relative inline-flex items-center bg-emerald-600 px-4 py-2 text-sm font-semibold text-white focus:outline-offset-0">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $page }}</a>
                                @endif
                            @endforeach
                            <a href="{{ $animals->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection