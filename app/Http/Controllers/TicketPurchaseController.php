<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketPurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'required|email',
            'ticket_type' => 'required|in:adult,child,senior,group,vip',
            'visit_date' => 'required|date|after_or_equal:today',
        ]);

        $prices = [
            'adult' => 15.00,
            'child' => 8.00,
            'senior' => 12.00,
            'group' => 10.00,
            'vip' => 35.00,
        ];

        $validated['price'] = $prices[$validated['ticket_type']];
        $validated['purchase_date'] = now();
        $validated['qr_code'] = 'TICKET_' . uniqid() . '_' . time();
        $validated['status'] = 'active';
        // $validated['user_id'] = auth()->id();

        $ticket = Ticket::create($validated);

        // You can add email sending here
        // Mail::to($ticket->visitor_email)->send(new TicketConfirmation($ticket));

        return redirect()->route('tickets.confirmation', $ticket)
            ->with('success', 'Ticket purchased successfully! Check your email for confirmation.');
    }

    public function confirmation(Ticket $ticket)
    {
        return view('tickets.confirmation', compact('ticket'));
    }

    public function myTickets()
    {
        $tickets = Ticket::where('visitor_email', Auth::user()->email ?? '')
            ->orWhere('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        
        return view('tickets.my-tickets', compact('tickets'));
    }
}