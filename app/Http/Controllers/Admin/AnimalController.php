<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Habitat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    
    public function index(): View
    {
        $animals = Animal::with('habitat')
            ->latest()
            ->paginate(10);

        return view('admin.animals.index', compact('animals'));
    }

    
    public function create(): View
    {
        $habitats = Habitat::orderBy('name')->get();
        return view('admin.animals.create', compact('habitats'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'species'       => 'required|string|max:255',
            'birth_date'    => 'nullable|date|before_or_equal:today',
            'health_status' => 'required|in:Excellent,Good,Fair,Poor,Critical',
            'habitat_id'    => 'nullable|exists:habitats,id',
            'description'   => 'nullable|string|max:2000',
        ]);

        Animal::create($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal "' . $validated['name'] . '" added successfully!');
    }

   
    public function edit(Animal $animal): View
    {
        $habitats = Habitat::orderBy('name')->get();
        return view('admin.animals.edit', compact('animal', 'habitats'));
    }


    public function update(Request $request, Animal $animal ): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'species'       => 'required|string|max:255',
            'birth_date'    => 'nullable|date|before_or_equal:today',
            'health_status' => 'required|in:Excellent,Good,Fair,Poor,Critical',
            'habitat_id'    => 'nullable|exists:habitats,id',
            'description'   => 'nullable|string|max:2000',
        ]);


        $animal->update($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal "' . $animal->name . '" updated successfully!');
    }

 
    public function destroy(Animal $animal) 
    {
        $name = $animal->name;


        $animal->delete();

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal "' . $name . '" deleted successfully!');
    }
}