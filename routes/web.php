<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnimalController;
use App\Http\Controllers\Admin\HabitatController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VeterinaryRecordController;
use App\Http\Controllers\StaffScheduleController;
use App\Http\Controllers\MaintenanceRecordController;
use App\Http\Controllers\TicketPurchaseController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/animals', [AnimalController::class, 'publicIndex'])->name('animals.public');
Route::get('/animals/{animal}', [AnimalController::class, 'publicShow'])->name('animals.public.show');

Route::get('/habitats', [HabitatController::class, 'publicIndex'])->name('habitats.public');
Route::get('/habitats/{habitat}', [HabitatController::class, 'publicShow'])->name('habitats.public.show');

Route::post('/tickets/purchase', [TicketPurchaseController::class, 'purchase'])->name('tickets.purchase');
Route::get('/tickets/confirmation/{ticket}', [TicketPurchaseController::class, 'confirmation'])->name('tickets.confirmation');
Route::get('/my-tickets', [TicketPurchaseController::class, 'myTickets'])->name('tickets.my')->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('animals', AnimalController::class);
        
        Route::resource('habitats', HabitatController::class);
        
        Route::resource('tickets', TicketController::class);
        
        Route::resource('users', UserController::class);
    });

// ==================== ROUTES VÉTÉRINAIRE ====================
Route::prefix('veterinary')
    ->name('veterinary.')
    ->middleware(['auth', 'veterinaire'])
    ->group(function () {
        Route::get('/records', [VeterinaryRecordController::class, 'index'])->name('index');
        Route::get('/animals/{animal}/records/create', [VeterinaryRecordController::class, 'create'])->name('records.create');
        Route::post('/animals/{animal}/records', [VeterinaryRecordController::class, 'store'])->name('records.store');
        Route::get('/records/{record}', [VeterinaryRecordController::class, 'show'])->name('records.show');
        Route::get('/records/{record}/edit', [VeterinaryRecordController::class, 'edit'])->name('records.edit');
        Route::put('/records/{record}', [VeterinaryRecordController::class, 'update'])->name('records.update');
        Route::delete('/records/{record}', [VeterinaryRecordController::class, 'destroy'])->name('records.destroy');
    });

// ==================== ROUTES PERSONNEL (Soigneurs) ====================
// Staff routes
Route::prefix('staff')
    ->name('staff.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', [StaffScheduleController::class, 'dashboard'])->name('dashboard');
        Route::get('/my-schedule', [StaffScheduleController::class, 'mySchedule'])->name('my-schedule');
        Route::get('/tasks', [StaffScheduleController::class, 'tasks'])->name('tasks');
        Route::post('/tasks/{schedule}/complete', [StaffScheduleController::class, 'completeTask'])->name('tasks.complete');
        Route::resource('schedules', StaffScheduleController::class);
    });
