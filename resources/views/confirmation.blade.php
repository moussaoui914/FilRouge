@extends('layouts.app')

@section('title', 'Ticket Confirmation')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-green-500 px-6 py-8 text-white text-center">
                <div class="text-5xl mb-3">✓</div>
                <h1 class="text-2xl font-bold">Payment Successful!</h1>
                <p>Your ticket has been confirmed</p>
            </div>
            <div class="p-6">
                <h2 class="font-bold text-xl mb-4">Ticket Details</h2>
                <div class="space-y-2">
                    <p><strong>Ticket ID:</strong> #{{ $ticket->id }}</p>
                    <p><strong>Visitor:</strong> {{ $ticket->visitor_name }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($ticket->ticket_type) }}</p>
                    <p><strong>Price:</strong> €{{ number_format($ticket->price, 2) }}</p>
                    <p><strong>Visit Date:</strong> {{ $ticket->visit_date->format('F j, Y') }}</p>
                </div>
                <a href="{{ route('home') }}" class="mt-6 inline-block w-full text-center bg-zoo-600 text-white py-2 rounded-lg">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection