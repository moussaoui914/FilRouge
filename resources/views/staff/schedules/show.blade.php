@extends('layouts.admin')

@section('title', 'Schedule Details - ZooQuarium')
@section('header', 'Schedule Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('staff.schedules.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Schedules
        </a>
    </div>

    <!-- Schedule Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 px-6 py-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-sm opacity-75 font-mono">Schedule #{{ $schedule->id }}</span>
                    <h1 class="text-2xl font-bold mt-1">Shift Details</h1>
                    <p class="text-emerald-100 text-sm mt-1">{{ $schedule->date->format('l, F j, Y') }}</p>
                </div>
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if($schedule->status == 'scheduled') bg-gray-600 text-white
                        @elseif($schedule->status == 'in_progress') bg-blue-600 text-white
                        @elseif($schedule->status == 'completed') bg-emerald-600 text-white
                        @else bg-rose-600 text-white @endif">
                        {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 lg:p-8">
            <!-- Staff Information -->
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Staff Member</h3>
                <div class="flex items-center space-x-4 bg-gray-50 rounded-xl p-4">
                    <div class="w-14 h-14 rounded-full bg-emerald-100 flex items-center justify-center">
                        <span class="text-xl font-bold text-emerald-700">{{ substr($schedule->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-800">{{ $schedule->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ ucfirst($schedule->user->role) }}</p>
                        <p class="text-xs text-gray-400">{{ $schedule->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Shift Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center text-gray-500 text-sm mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Date
                    </div>
                    <p class="text-gray-800 font-medium">{{ $schedule->date->format('F j, Y') }}</p>
                    <p class="text-xs text-gray-500">{{ $schedule->date->format('l') }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center text-gray-500 text-sm mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Shift Hours
                    </div>
                    <p class="text-gray-800 font-medium">
                        {{ date('H:i', strtotime($schedule->shift_start)) }} - {{ date('H:i', strtotime($schedule->shift_end)) }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Duration: {{ (strtotime($schedule->shift_end) - strtotime($schedule->shift_start)) / 3600 }} hours
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center text-gray-500 text-sm mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Sector
                    </div>
                    <p class="text-gray-800 font-medium">{{ $schedule->sector ?? 'Not specified' }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center text-gray-500 text-sm mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Status
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($schedule->status == 'scheduled') bg-gray-100 text-gray-700
                        @elseif($schedule->status == 'in_progress') bg-blue-100 text-blue-700
                        @elseif($schedule->status == 'completed') bg-emerald-100 text-emerald-700
                        @else bg-rose-100 text-rose-700 @endif">
                        {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                    </span>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Assigned Tasks</h3>
                <div class="bg-gray-50 rounded-xl p-5">
                    @if($schedule->tasks)
                        <div class="space-y-3">
                            @php
                                $tasks = explode("\n", $schedule->tasks);
                            @endphp
                            @foreach($tasks as $task)
                                @if(trim($task))
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 text-emerald-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p class="text-gray-700">{{ trim($task) }}</p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500">No tasks assigned for this shift</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Shift Timeline</h3>
                <div class="relative">
                    <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    
                    <div class="relative flex items-start mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center z-10">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-medium text-gray-800">Shift Start</p>
                            <p class="text-sm text-gray-500">{{ date('H:i', strtotime($schedule->shift_start)) }}</p>
                        </div>
                    </div>

                    @if($schedule->status == 'in_progress' || $schedule->status == 'completed')
                    <div class="relative flex items-start mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center z-10">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-medium text-gray-800">In Progress</p>
                            <p class="text-sm text-gray-500">Shift is currently active</p>
                        </div>
                    </div>
                    @endif

                    @if($schedule->status == 'completed')
                    <div class="relative flex items-start">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center z-10">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-medium text-gray-800">Shift Completed</p>
                            <p class="text-sm text-gray-500">All tasks have been completed</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('staff.schedules.edit', $schedule) }}" 
                   class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Schedule
                </a>
                <form action="{{ route('staff.schedules.destroy', $schedule) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this schedule?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Schedule
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection