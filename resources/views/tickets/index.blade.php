@extends('layouts.app')

@section('title', 'Manage Tickets - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Manage Tickets</h1>
            <a href="{{ route('admin.tickets.create') }}" 
               class="bg-zoo-600 text-white px-4 py-2 rounded-lg hover:bg-zoo-700 transition">
                + Create New Ticket
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Total Tickets</p>
                <p class="text-2xl font-bold">{{ $tickets->total() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Active Tickets</p>
                <p class="text-2xl font-bold text-green-600">{{ $tickets->where('status', 'active')->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Today's Visitors</p>
                <p class="text-2xl font-bold text-blue-600">{{ $tickets->where('visit_date', today())->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-500 text-sm">Total Revenue</p>
                <p class="text-2xl font-bold text-zoo-600">€{{ number_format($tickets->sum('price'), 2) }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="Search by name or email" 
                       value="{{ request('search') }}"
                       class="px-3 py-2 border border-gray-300 rounded-lg">
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="used" {{ request('status') == 'used' ? 'selected' : '' }}>Used</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <select name="ticket_type" class="px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Types</option>
                    <option value="adult" {{ request('ticket_type') == 'adult' ? 'selected' : '' }}>Adult</option>
                    <option value="child" {{ request('ticket_type') == 'child' ? 'selected' : '' }}>Child</option>
                    <option value="senior" {{ request('ticket_type') == 'senior' ? 'selected' : '' }}>Senior</option>
                    <option value="group" {{ request('ticket_type') == 'group' ? 'selected' : '' }}>Group</option>
                    <option value="vip" {{ request('ticket_type') == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Filter</button>
            </form>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">QR Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visitor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visit Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">
                                <span class="text-lg">🎫</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ $ticket->visitor_name }}</div>
                            <div class="text-sm text-gray-500">{{ $ticket->visitor_email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100">
                                {{ ucfirst($ticket->ticket_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">€{{ number_format($ticket->price, 2) }}</td>
                        <td class="px-6 py-4">{{ $ticket->visit_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($ticket->status == 'active') bg-green-100 text-green-800
                                @elseif($ticket->status == 'used') bg-blue-100 text-blue-800
                                @elseif($ticket->status == 'expired') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                <a href="{{ route('admin.tickets.edit', $ticket) }}" class="text-green-600 hover:text-green-800">Edit</a>
                                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Delete this ticket?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No tickets found. <a href="{{ route('admin.tickets.create') }}" class="text-zoo-600">Create your first ticket</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection