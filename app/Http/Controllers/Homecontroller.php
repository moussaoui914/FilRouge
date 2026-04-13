<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Habitat;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'animals'  => Animal::count(),
            'habitats' => Habitat::count(),
            'visitors' => 48_320,
        ];

        return view('home', compact('stats'));
    }
}