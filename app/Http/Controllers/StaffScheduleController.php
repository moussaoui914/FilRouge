<?php

namespace App\Http\Controllers;

use App\Models\StaffSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display the current user's schedule (my schedule)
     */
    public function mySchedule(): View
    {
        $schedules = StaffSchedule::where('user_id', Auth::id())
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->orderBy('shift_start')
            ->paginate(10);
        
        return view('staff.my-schedule', compact('schedules'));
    }

    /**
     * Dashboard for staff members
     */
    public function dashboard(): View
    {
        $upcomingSchedules = StaffSchedule::where('user_id', Auth::id())
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->orderBy('shift_start')
            ->take(5)
            ->get();
        
        $todaySchedule = StaffSchedule::where('user_id', Auth::id())
            ->whereDate('date', today())
            ->first();
        
        $completedShifts = StaffSchedule::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
        
        $pendingShifts = StaffSchedule::where('user_id', Auth::id())
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->count();
        
        return view('staff.dashboard', compact('upcomingSchedules', 'todaySchedule', 'completedShifts', 'pendingShifts'));
    }

    /**
     * Display tasks for the current user
     */
    public function tasks(): View
    {
        $tasks = StaffSchedule::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->orderBy('shift_start')
            ->paginate(10);
        
        return view('staff.tasks', compact('tasks'));
    }

    /**
     * Mark a task as completed
     */
    public function completeTask(StaffSchedule $schedule)
    {
        if ($schedule->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to complete this task.');
        }
        
        $schedule->update(['status' => 'completed']);
        
        return back()->with('success', 'Task marked as completed successfully.');
    }
}