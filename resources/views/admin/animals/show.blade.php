@extends('layouts.app')

@section('title', $animal->name . ' - ZooQuarium')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Navigation Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-emerald-600 transition">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('animals.public') }}" class="hover:text-emerald-600 transition">Animals</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-700 font-medium">{{ $animal->name }}</span>
        </nav>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="grid lg:grid-cols-2 gap-0">
                
                <!-- Image Section -->
                <div class="relative bg-gradient-to-br from-gray-100 to-gray-200 min-h-[400px] lg:min-h-[500px]">
                    @if($animal->image)
                        <img src="{{ Storage::url($animal->image) }}" 
                             alt="{{ $animal->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Health Status Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
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

                <!-- Info Section -->
                <div class="p-8 lg:p-10">
                    <!-- Title -->
                    <div class="mb-6">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $animal->name }}</h1>
                        <p class="text-lg text-emerald-600 font-medium">{{ $animal->species }}</p>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center text-gray-500 text-sm mb-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Age
                            </div>
                            <p class="text-xl font-semibold text-gray-800">{{ $animal->age ?? 'Unknown' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center text-gray-500 text-sm mb-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Habitat
                            </div>
                            <p class="text-xl font-semibold text-gray-800">
                                @if($animal->habitat)
                                    <a href="{{ route('habitats.public.show', $animal->habitat) }}" class="text-emerald-600 hover:text-emerald-700">
                                        {{ $animal->habitat->name }}
                                    </a>
                                @else
                                    Unknown
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Birth Date -->
                    @if($animal->birth_date)
                    <div class="flex items-center text-gray-600 mb-4">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                        </svg>
                        <span class="text-gray-600">Born: </span>
                        <span class="font-medium text-gray-800 ml-1">{{ $animal->birth_date->format('F j, Y') }}</span>
                    </div>
                    @endif

                    <!-- Description -->
                    <div class="border-t border-gray-100 pt-6 mt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">About {{ $animal->name }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $animal->description ?? 'No description available for this animal.' }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 mt-8 pt-4 border-t border-gray-100">
                        <a href="{{ route('animals.public') }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Animals
                        </a>
                        <a href="#buy-tickets" 
                           class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            Buy Tickets
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Veterinary Records Section (for staff only) -->
        @auth
            @if(auth()->user()->isVeterinaire() || auth()->user()->isAdmin())
            <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Medical Records</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Veterinary history for {{ $animal->name }}</p>
                    </div>
                    @if(auth()->user()->isVeterinaire())
                    <a href="{{ route('veterinary.records.create', $animal) }}" 
                       class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-lg transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Record
                    </a>
                    @endif
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Treatment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Veterinarian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($veterinaryRecords ?? [] as $record)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 text-gray-600">{{ $record->record_date->format('M d, Y') }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                        @if($record->type == 'checkup') bg-blue-100 text-blue-700
                                        @elseif($record->type == 'vaccination') bg-green-100 text-green-700
                                        @elseif($record->type == 'treatment') bg-amber-100 text-amber-700
                                        @elseif($record->type == 'surgery') bg-purple-100 text-purple-700
                                        @else bg-rose-100 text-rose-700 @endif">
                                        {{ ucfirst($record->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-gray-600">{{ Str::limit($record->diagnosis, 50) ?: '-' }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ Str::limit($record->treatment, 50) ?: '-' }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $record->veterinarian->name ?? 'Unknown' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 3-3-1-3 1-1-3zM5 12h14M5 12a7 7 0 1114 0M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6"></path>
                                        </svg>
                                        <p>No medical records available</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        @endauth
    </div>
</div>
@endsection