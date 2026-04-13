<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Habitat;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'animals'   => Animal::count(),
            'habitats'  => Habitat::count(),
            'users'     => User::count(),
            'critical'  => Animal::where('health_status', 'Critical')->count(),
        ];

        $recentAnimals = Animal::with('habitat')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentAnimals'));
    }
}