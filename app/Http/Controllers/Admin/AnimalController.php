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
    public function index()
    {
        $animals = Animal::with('habitat')->latest()->paginate(15);
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        $habitats = Habitat::all();
        return view('admin.animals.create', compact('habitats'));
    }

    public function store(Request $request)
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

    public function show(Animal $animal)
    {
        $animal->load('habitat');
        $veterinaryRecords = $animal->veterinaryRecords()->with('veterinarian')->latest()->take(5)->get();
        return view('admin.animals.show', compact('animal', 'veterinaryRecords'));
    }

    public function edit(Animal $animal)
    {
        $habitats = Habitat::all();
        return view('admin.animals.edit', compact('animal', 'habitats'));
    }

    public function update(Request $request, Animal $animal)
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

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal deleted successfully.');
    }

    public function publicIndex()
{
    $animals = Animal::with('habitat')->paginate(12);
    return view('animals.public-index', compact('animals'));
}

public function publicShow(Animal $animal)
{
    $animal->load('habitat');
    $veterinaryRecords = $animal->veterinaryRecords()->with('veterinarian')->latest()->take(5)->get();
    return view('animals.public-show', compact('animal', 'veterinaryRecords'));
}

}