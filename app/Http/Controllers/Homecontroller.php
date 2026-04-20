<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Habitat;
use App\Models\Ticket;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'animals'  => Animal::count(),
            'habitats' => Habitat::count(),
            'visitors' => 48320,
            'tickets_sold' => Ticket::where('status', 'active')->count(),
        ];

        return view('home', compact('stats'));
    }
}