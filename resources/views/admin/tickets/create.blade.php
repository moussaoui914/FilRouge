@extends('layouts.app')

@section('title', 'Create Ticket - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Create New Ticket</h1>

            <form action="{{ route('admin.tickets.store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Visitor Name *</label>
                        <input type="text" name="visitor_name" value="{{ old('visitor_name') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500"
                               placeholder="Full name">
                        @error('visitor_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                        <input type="email" name="visitor_email" value="{{ old('visitor_email') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500"
                               placeholder="visitor@example.com">
                        @error('visitor_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Type *</label>
                        <select name="ticket_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                            <option value="">Select ticket type</option>
                            <option value="adult" {{ old('ticket_type') == 'adult' ? 'selected' : '' }}>Adult - €15.00</option>
                            <option value="child" {{ old('ticket_type') == 'child' ? 'selected' : '' }}>Child (3-12) - €8.00</option>
                            <option value="senior" {{ old('ticket_type') == 'senior' ? 'selected' : '' }}>Senior (65+) - €12.00</option>
                            <option value="group" {{ old('ticket_type') == 'group' ? 'selected' : '' }}>Group (10+ people) - €10.00 each</option>
                            <option value="vip" {{ old('ticket_type') == 'vip' ? 'selected' : '' }}>VIP Experience - €35.00</option>
                        </select>
                        @error('ticket_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Visit Date *</label>
                        <input type="date" name="visit_date" value="{{ old('visit_date') }}" required
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('visit_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Price Preview -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2">Price will be calculated based on ticket type:</p>
                        <ul class="text-sm space-y-1">
                            <li>🎫 Adult: €15.00</li>
                            <li>👶 Child (3-12): €8.00</li>
                            <li>👴 Senior (65+): €12.00</li>
                            <li>👥 Group (10+): €10.00 per person</li>
                            <li>⭐ VIP: €35.00</li>
                        </ul>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.tickets.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-zoo-600 text-white rounded-lg hover:bg-zoo-700 transition">
                            Create Ticket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection