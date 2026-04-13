<?php

namespace App\Http\Controllers;

use App\Models\StaffSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffScheduleController extends Controller
{
    public function index(): View
    {
        $schedules = StaffSchedule::with('user')
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->orderBy('shift_start')
            ->paginate(20);
        return view('staff.schedules.index', compact('schedules'));
    }

    public function create(): View
    {
        $staff = User::whereIn('role', ['responsable', 'soigneur', 'veterinaire', 'maintenance'])->get();
        return view('staff.schedules.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'shift_start' => 'required|date_format:H:i',
            'shift_end' => 'required|date_format:H:i|after:shift_start',
            'sector' => 'nullable|string',
            'tasks' => 'nullable|string',
        ]);

        StaffSchedule::create($validated);

        return redirect()->route('staff.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function show(StaffSchedule $schedule): View
    {
        $schedule->load('user');
        return view('staff.schedules.show', compact('schedule'));
    }

    public function edit(StaffSchedule $schedule): View
    {
        $staff = User::whereIn('role', ['responsable', 'soigneur', 'veterinaire', 'maintenance'])->get();
        return view('staff.schedules.edit', compact('schedule', 'staff'));
    }

    public function update(Request $request, StaffSchedule $schedule)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'shift_start' => 'required|date_format:H:i',
            'shift_end' => 'required|date_format:H:i|after:shift_start',
            'sector' => 'nullable|string',
            'tasks' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,absent',
        ]);

        $schedule->update($validated);

        return redirect()->route('staff.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(StaffSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('staff.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}