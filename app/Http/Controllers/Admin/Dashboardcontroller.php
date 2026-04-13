<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Habitat;
use App\Models\User;
use App\Models\Ticket;
use App\Models\VeterinaryRecord;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_animals' => Animal::count(),
            'total_habitats' => Habitat::count(),
            'total_staff' => User::whereIn('role', ['responsable', 'soigneur', 'veterinaire', 'billetterie', 'maintenance'])->count(),
            'total_tickets' => Ticket::count(),
            'monthly_revenue' => Ticket::whereMonth('purchase_date', now()->month)->sum('price'),
            'pending_maintenance' => \App\Models\MaintenanceRecord::where('status', 'pending')->count(),
            'today_visitors' => Ticket::where('visit_date', today())->count(),
            'animals_health_critical' => Animal::where('health_status', 'Critical')->count(),
        ];

        $recentAnimals = Animal::with('habitat')->latest()->take(5)->get();
        $recentTickets = Ticket::latest()->take(5)->get();
        $todaySchedules = \App\Models\StaffSchedule::with('user')
            ->where('date', today())
            ->orderBy('shift_start')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAnimals', 'recentTickets', 'todaySchedules'));
    }
}