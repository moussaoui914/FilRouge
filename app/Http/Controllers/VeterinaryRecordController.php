<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\VeterinaryRecord;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VeterinaryRecordController extends Controller
{
    public function index(): View
    {
        $records = VeterinaryRecord::with(['animal', 'veterinarian'])
            ->latest('record_date')
            ->paginate(15);
        return view('veterinary.index', compact('records'));
    }

    public function create(Animal $animal): View
    {
        return view('veterinary.create', compact('animal'));
    }

    public function store(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'type' => 'required|in:checkup,vaccination,treatment,surgery,emergency',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'medication' => 'nullable|string',
            'dosage' => 'nullable|string',
            'next_appointment' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['animal_id'] = $animal->id;
        // $validated['veterinarian_id'] = auth()->id();
        $validated['record_date'] = now();
        $validated['status'] = 'completed';

        VeterinaryRecord::create($validated);

        return redirect()->route('animals.show', $animal)
            ->with('success', 'Veterinary record added successfully.');
    }

    public function show(VeterinaryRecord $record): View
    {
        $record->load(['animal', 'veterinarian']);
        return view('veterinary.show', compact('record'));
    }

    public function edit(VeterinaryRecord $record): View
    {
        return view('veterinary.edit', compact('record'));
    }

    public function update(Request $request, VeterinaryRecord $record)
    {
        $validated = $request->validate([
            'type' => 'required|in:checkup,vaccination,treatment,surgery,emergency',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'medication' => 'nullable|string',
            'dosage' => 'nullable|string',
            'next_appointment' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $record->update($validated);

        return redirect()->route('veterinary.show', $record)
            ->with('success', 'Veterinary record updated successfully.');
    }

    public function destroy(VeterinaryRecord $record)
    {
        $record->delete();
        return redirect()->route('veterinary.index')
            ->with('success', 'Veterinary record deleted successfully.');
    }
}