<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Habitat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitatController extends Controller
{
    public function index(): View
    {
        $habitats = Habitat::withCount('animals')->latest()->paginate(10);
        return view('admin.habitats.index', compact('habitats'));
    }

    public function create(): View
    {
        return view('admin.habitats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('habitats', 'public');
            $validated['image'] = $path;
        }

        Habitat::create($validated);

        return redirect()->route('admin.habitats.index')
            ->with('success', 'Habitat created successfully.');
    }

    public function show(Habitat $habitat): View
    {
        $habitat->load('animals');
        return view('admin.habitats.show', compact('habitat'));
    }

    public function edit(Habitat $habitat): View
    {
        return view('admin.habitats.edit', compact('habitat'));
    }

    public function update(Request $request, Habitat $habitat)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('habitats', 'public');
            $validated['image'] = $path;
        }

        $habitat->update($validated);

        return redirect()->route('admin.habitats.index')
            ->with('success', 'Habitat updated successfully.');
    }

    public function destroy(Habitat $habitat)
    {
        $habitat->delete();
        return redirect()->route('admin.habitats.index')
            ->with('success', 'Habitat deleted successfully.');
    }

        public function publicIndex(): View
    {
        $habitats = Habitat::withCount('animals')->paginate(12);
        return view('habitats.public-index', compact('habitats'));
    }

    public function publicShow(Habitat $habitat): View
    {
        $habitat->load('animals');
        return view('habitats.public-show', compact('habitat'));
    }
}