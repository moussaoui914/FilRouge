@extends('layouts.app')

@section('title', 'My Schedule - ZooQuarium')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">My Schedule</h1>
            <p class="text-sm text-gray-500 mt-1">View your upcoming shifts and tasks</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="space-y-4">
            @forelse($schedules as $schedule)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                <div class="p-5">
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $schedule->date->format('l, F j, Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $schedule->date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($schedule->status == 'scheduled') bg-gray-100 text-gray-700
                                @elseif($schedule->status == 'in_progress') bg-blue-100 text-blue-700
                                @elseif($schedule->status == 'completed') bg-emerald-100 text-emerald-700
                                @else bg-rose-100 text-rose-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">{{ date('H:i', strtotime($schedule->shift_start)) }} - {{ date('H:i', strtotime($schedule->shift_end)) }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-sm">{{ $schedule->sector ?? 'General' }}</span>
                        </div>
                    </div>

                    @if($schedule->tasks)
                    <div class="mt-4 bg-gray-50 rounded-lg p-3">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-sm text-gray-600">{{ $schedule->tasks }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-500 font-medium">No schedules found</p>
                    <p class="text-gray-400 text-sm mt-1">You don't have any upcoming shifts</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection