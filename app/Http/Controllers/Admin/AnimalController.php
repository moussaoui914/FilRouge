<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Habitat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnimalController extends Controller
{
    public function index(): View
    {
        $animals = Animal::with('habitat')->latest()->paginate(15);
        return view('admin.animals.index', compact('animals'));
    }

    public function create(): View
    {
        $habitats = Habitat::all();
        return view('admin.animals.create', compact('habitats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'health_status' => 'required|in:Excellent,Good,Fair,Poor,Critical',
            'habitat_id' => 'nullable|exists:habitats,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('animals', 'public');
            $validated['image'] = $path;
        }

        Animal::create($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal created successfully.');
    }

    public function show(Animal $animal): View
    {
        $animal->load('habitat');
        $veterinaryRecords = $animal->veterinaryRecords()->with('veterinarian')->latest()->take(5)->get();
        return view('admin.animals.show', compact('animal', 'veterinaryRecords'));
    }

    public function edit(Animal $animal): View
    {
        $habitats = Habitat::all();
        return view('admin.animals.edit', compact('animal', 'habitats'));
    }

    public function update(Request $request, Animal $animal): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'health_status' => 'required|in:Excellent,Good,Fair,Poor,Critical',
            'habitat_id' => 'nullable|exists:habitats,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('animals', 'public');
            $validated['image'] = $path;
        }

        $animal->update($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal updated successfully.');
    }

    public function destroy(Animal $animal): RedirectResponse
    {
        $animal->delete();
        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal deleted successfully.');
    }

    public function publicIndex(): View
{
    $animals = Animal::with('habitat')->paginate(12);
    return view('animals.public-index', compact('animals'));
}

public function publicShow(Animal $animal): View
{
    $animal->load('habitat');
    $veterinaryRecords = $animal->veterinaryRecords()->with('veterinarian')->latest()->take(5)->get();
    return view('animals.public-show', compact('animal', 'veterinaryRecords'));
}

}