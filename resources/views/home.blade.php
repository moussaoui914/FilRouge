@extends('layouts.app')

@section('title', 'ZooQuarium - Experience Wildlife')

@section('content')
<div class="relative">
    <!-- Hero Section -->
    <div class="relative h-[600px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1549366021-9f761d450615?ixlib=rb-4.0.3');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">Welcome to ZooQuarium</h1>
                <p class="text-xl md:text-2xl mb-8 max-w-2xl">Experience the magic of wildlife with over {{ $stats['animals'] }} animals in their natural habitats</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#buy-tickets" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-lg font-semibold transition shadow-lg">
                        Buy Tickets
                    </a>
                    <a href="{{ route('animals.public') }}" class="bg-white hover:bg-gray-100 text-gray-800 px-8 py-3 rounded-lg font-semibold transition shadow-lg">
                        Explore Animals
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-5xl font-bold text-emerald-600 mb-2">{{ $stats['animals'] }}+</div>
                    <div class="text-gray-600 font-medium">Amazing Animals</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold text-emerald-600 mb-2">{{ $stats['habitats'] }}</div>
                    <div class="text-gray-600 font-medium">Natural Habitats</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold text-emerald-600 mb-2">{{ number_format($stats['visitors']) }}+</div>
                    <div class="text-gray-600 font-medium">Happy Visitors</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold text-emerald-600 mb-2">{{ $stats['tickets_sold'] ?? 0 }}</div>
                    <div class="text-gray-600 font-medium">Tickets Sold</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buy Tickets Section -->
    <div id="buy-tickets" class="py-16 bg-gradient-to-r from-emerald-50 to-teal-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Book Your Visit Today</h2>
                <p class="text-gray-600 text-lg">Choose from our range of ticket options</p>
            </div>

            <!-- Ticket Types Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Adult</h3>
                    <p class="text-2xl font-bold text-emerald-600">€15</p>
                    <p class="text-sm text-gray-500 mt-2">Ages 13-64</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Child</h3>
                    <p class="text-2xl font-bold text-emerald-600">€8</p>
                    <p class="text-sm text-gray-500 mt-2">Ages 3-12</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Senior</h3>
                    <p class="text-2xl font-bold text-emerald-600">€12</p>
                    <p class="text-sm text-gray-500 mt-2">Ages 65+</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Group</h3>
                    <p class="text-2xl font-bold text-emerald-600">€10</p>
                    <p class="text-sm text-gray-500 mt-2">10+ people</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">VIP</h3>
                    <p class="text-2xl font-bold text-amber-600">€35</p>
                    <p class="text-sm text-gray-500 mt-2">Premium experience</p>
                </div>
            </div>

            <!-- Purchase Form -->
            <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Purchase Your Tickets</h3>
                
                <form action="{{ route('tickets.purchase') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="visitor_name" required
                                       class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                       placeholder="Your full name">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" name="visitor_email" required
                                       class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                       placeholder="you@example.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Type *</label>
                            <select name="ticket_type" required 
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                <option value="adult">Adult - €15.00</option>
                                <option value="child">Child (3-12) - €8.00</option>
                                <option value="senior">Senior (65+) - €12.00</option>
                                <option value="group">Group (10+ people) - €10.00 each</option>
                                <option value="vip">VIP Experience - €35.00</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Visit Date *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="visit_date" required min="{{ date('Y-m-d') }}"
                                       class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Instant ticket delivery via email
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Free cancellation up to 24 hours before
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                QR code for contactless entry
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-lg transition shadow-md">
                            Purchase Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Animals Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Meet Our Animals</h2>
                <p class="text-gray-600">Discover our incredible wildlife collection</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $featuredAnimals = App\Models\Animal::with('habitat')->take(3)->get();
                @endphp
                @foreach($featuredAnimals as $animal)
                <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($animal->image)
                        <img src="{{ Storage::url($animal->image) }}" alt="{{ $animal->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $animal->name }}</h3>
                        <p class="text-emerald-600 font-medium mb-2">{{ $animal->species }}</p>
                        <p class="text-sm text-gray-500">Habitat: {{ $animal->habitat->name ?? 'Unknown' }}</p>
                        <a href="{{ route('animals.public.show', $animal) }}" class="mt-4 inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition">
                            Learn More
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection