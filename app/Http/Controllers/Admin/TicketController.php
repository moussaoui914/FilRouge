<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = Ticket::with('user')->latest()->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
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
        $validated['qr_code'] = uniqid('TICKET_') . '_' . time();
        // $validated['user_id'] = auth()->id();

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket): View
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket): View
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'required|email',
            'ticket_type' => 'required|in:adult,child,senior,group,vip',
            'visit_date' => 'required|date',
            'status' => 'required|in:active,used,expired,cancelled',
        ]);

        $prices = [
            'adult' => 15.00,
            'child' => 8.00,
            'senior' => 12.00,
            'group' => 10.00,
            'vip' => 35.00,
        ];

        $validated['price'] = $prices[$validated['ticket_type']];
        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}