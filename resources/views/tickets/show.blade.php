@extends('layouts.app')

@section('title', 'Ticket Details - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <!-- Ticket Header -->
            <div class="bg-gradient-to-r from-zoo-700 to-zoo-900 px-6 py-8 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-sm opacity-75">Ticket #{{ $ticket->id }}</span>
                        <h1 class="text-2xl font-bold mt-1">ZooQuarium Entry Ticket</h1>
                    </div>
                    <div class="text-right">
                        <span class="text-3xl">🎫</span>
                    </div>
                </div>
            </div>

            <!-- Ticket Content -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Visitor Information</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-500 w-24 inline-block">Name:</span> <strong>{{ $ticket->visitor_name }}</strong></p>
                            <p><span class="text-gray-500 w-24 inline-block">Email:</span> {{ $ticket->visitor_email }}</p>
                        </div>

                        <h3 class="font-semibold text-gray-900 mt-4 mb-3">Ticket Information</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-500 w-24 inline-block">Type:</span> 
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100">{{ ucfirst($ticket->ticket_type) }}</span>
                            </p>
                            <p><span class="text-gray-500 w-24 inline-block">Price:</span> <strong class="text-zoo-600">€{{ number_format($ticket->price, 2) }}</strong></p>
                            <p><span class="text-gray-500 w-24 inline-block">Purchase Date:</span> {{ $ticket->purchase_date->format('F j, Y H:i') }}</p>
                            <p><span class="text-gray-500 w-24 inline-block">Visit Date:</span> <strong>{{ $ticket->visit_date->format('F j, Y') }}</strong></p>
                            <p><span class="text-gray-500 w-24 inline-block">Status:</span> 
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($ticket->status == 'active') bg-green-100 text-green-800
                                    @elseif($ticket->status == 'used') bg-blue-100 text-blue-800
                                    @elseif($ticket->status == 'expired') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Right Column - QR Code -->
                    <div class="border-l border-gray-200 pl-6">
                        <h3 class="font-semibold text-gray-900 mb-3">QR Code</h3>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="w-48 h-48 mx-auto bg-white rounded-lg shadow flex items-center justify-center">
                                <!-- Simple QR Code representation -->
                                <div class="text-center">
                                    <div class="text-6xl mb-2">🎫</div>
                                    <div class="text-xs text-gray-500">{{ $ticket->qr_code }}</div>
                                    <div class="text-xs text-gray-400 mt-2">Scan at entrance</div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3">Show this QR code at the entrance</p>
                        </div>
                    </div>
                </div>

                <!-- Important Info -->
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-semibold text-yellow-800 mb-2">Important Information</h4>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>✓ Please arrive at least 15 minutes before your scheduled visit time</li>
                        <li>✓ This ticket is non-refundable but can be rescheduled</li>
                        <li>✓ Children under 3 years old enter for free</li>
                        <li>✓ Show this QR code at the entrance for scanning</li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.tickets.edit', $ticket) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Edit Ticket
                    </a>
                    <a href="{{ route('admin.tickets.index') }}" 
                       class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection