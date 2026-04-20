@extends('layouts.admin')

@section('title', 'Ticket Details - ZooQuarium')
@section('header', 'Ticket Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.tickets.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Tickets
        </a>
    </div>

    <!-- Ticket Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Ticket Header -->
        <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 px-6 py-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-sm opacity-75 font-mono">Ticket #{{ $ticket->id }}</span>
                    <h1 class="text-2xl font-bold mt-1">ZooQuarium Entry Ticket</h1>
                </div>
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Ticket Content -->
        <div class="p-6 lg:p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column - Information -->
                <div>
                    <!-- Visitor Information -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Visitor Information</h3>
                        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-gray-500 w-20">Name:</span>
                                <span class="font-medium text-gray-800">{{ $ticket->visitor_name }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-500 w-20">Email:</span>
                                <span class="text-gray-600">{{ $ticket->visitor_email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Information -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Ticket Information</h3>
                        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                <span class="text-gray-500 w-24">Type:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($ticket->ticket_type == 'vip') bg-amber-100 text-amber-800
                                    @elseif($ticket->ticket_type == 'adult') bg-blue-100 text-blue-800
                                    @elseif($ticket->ticket_type == 'child') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($ticket->ticket_type) }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-500 w-24">Price:</span>
                                <span class="font-semibold text-emerald-600">€{{ number_format($ticket->price, 2) }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-500 w-24">Purchase Date:</span>
                                <span class="text-gray-600">{{ $ticket->purchase_date->format('F j, Y H:i') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-500 w-24">Visit Date:</span>
                                <span class="font-medium text-gray-800">{{ $ticket->visit_date->format('F j, Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-500 w-24">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($ticket->status == 'active') bg-emerald-100 text-emerald-800
                                    @elseif($ticket->status == 'used') bg-blue-100 text-blue-800
                                    @elseif($ticket->status == 'expired') bg-gray-100 text-gray-600
                                    @else bg-rose-100 text-rose-800 @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - QR Code -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Entry Pass</h3>
                    <div class="bg-gray-50 rounded-xl p-6 text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-xl shadow-md flex items-center justify-center border border-gray-100">
                            <div class="text-center">
                                <svg class="w-20 h-20 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                <div class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $ticket->qr_code }}</div>
                                <div class="text-xs text-gray-400 mt-2">Scan at entrance</div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-4">Present this QR code at the zoo entrance for scanning</p>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="mt-8 bg-amber-50 border border-amber-100 rounded-xl p-5">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-amber-800 mb-2">Important Information</h4>
                        <ul class="text-sm text-amber-700 space-y-1">
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Please arrive at least 15 minutes before your scheduled visit time
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                This ticket is non-refundable but can be rescheduled
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Children under 3 years old enter for free
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Show this QR code at the entrance for scanning
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.tickets.edit', $ticket) }}" 
                   class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Ticket
                </a>
                <a href="{{ route('admin.tickets.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection