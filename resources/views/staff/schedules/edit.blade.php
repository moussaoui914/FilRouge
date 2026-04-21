@extends('layouts.admin')

@section('title', 'Edit Schedule - ZooQuarium')
@section('header', 'Edit Schedule')

@section('content')
<div class="max-w-3xl mx-auto">
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

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Edit Schedule</h2>
            <p class="text-xs text-gray-500 mt-0.5">Update shift information for schedule #{{ $schedule->id }}</p>
        </div>

        <form action="{{ route('staff.schedules.update', $schedule) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Staff Member Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Staff Member <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <select name="user_id" required 
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent appearance-none bg-white">
                            <option value="">Select a staff member</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}" {{ old('user_id', $schedule->user_id) == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ ucfirst($member->role) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="date" name="date" value="{{ old('date', $schedule->date->format('Y-m-d')) }}" required
                               min="{{ date('Y-m-d') }}"
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shift Start Time -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Shift Start <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="time" name="shift_start" value="{{ old('shift_start', date('H:i', strtotime($schedule->shift_start))) }}" required
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    @error('shift_start')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shift End Time -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Shift End <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="time" name="shift_end" value="{{ old('shift_end', date('H:i', strtotime($schedule->shift_end))) }}" required
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    @error('shift_end')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sector -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sector <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <select name="sector" 
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent appearance-none bg-white">
                            <option value="">Select a sector</option>
                            <option value="Savanna" {{ old('sector', $schedule->sector) == 'Savanna' ? 'selected' : '' }}>Savanna</option>
                            <option value="Forest" {{ old('sector', $schedule->sector) == 'Forest' ? 'selected' : '' }}>Forest</option>
                            <option value="Aquatic" {{ old('sector', $schedule->sector) == 'Aquatic' ? 'selected' : '' }}>Aquatic</option>
                            <option value="Desert" {{ old('sector', $schedule->sector) == 'Desert' ? 'selected' : '' }}>Desert</option>
                            <option value="Tundra" {{ old('sector', $schedule->sector) == 'Tundra' ? 'selected' : '' }}>Tundra</option>
                            <option value="Mountain" {{ old('sector', $schedule->sector) == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                            <option value="Tropical" {{ old('sector', $schedule->sector) == 'Tropical' ? 'selected' : '' }}>Tropical</option>
                            <option value="Entrance" {{ old('sector', $schedule->sector) == 'Entrance' ? 'selected' : '' }}>Entrance</option>
                            <option value="Gift Shop" {{ old('sector', $schedule->sector) == 'Gift Shop' ? 'selected' : '' }}>Gift Shop</option>
                            <option value="Restaurant" {{ old('sector', $schedule->sector) == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                        </select>
                    </div>
                    @error('sector')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <select name="status" required 
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent appearance-none bg-white">
                            <option value="scheduled" {{ old('status', $schedule->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="in_progress" {{ old('status', $schedule->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="absent" {{ old('status', $schedule->status) == 'absent' ? 'selected' : '' }}>Absent</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tasks Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tasks <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <textarea name="tasks" rows="5" 
                                  class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                  placeholder="List the tasks for this shift...&#10;Example:&#10;- Feed the lions at 9 AM&#10;- Clean the savanna enclosure&#10;- Health check for giraffes">{{ old('tasks', $schedule->tasks) }}</textarea>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Enter each task on a new line or separate with bullet points</p>
                    @error('tasks')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warning Box for Status Change -->
                <div class="bg-amber-50 rounded-lg p-4 border border-amber-100">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-amber-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-amber-800 text-sm">Note about status changes</h4>
                            <p class="text-xs text-amber-700 mt-1">
                                Changing the status to "Completed" will mark this shift as finished. 
                                This action can be reversed if needed.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('staff.schedules.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Schedule
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection