<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LAEventController;
use Illuminate\Support\Facades\Route;

// Redirect to login or events depending on auth status
Route::get('/', function () {
    return auth()->check() ? redirect()->route('events.index') : redirect()->route('login');
});

// Guest routes (registration, login, etc.)
Route::middleware('guest')->group(function () {
    require __DIR__ . '/auth.php';
});

// Authenticated user routes
Route::middleware('auth')->group(function () {

    // Public event access (for all logged-in users)
    Route::get('/events', [LAEventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [LAEventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/register', [LAEventController::class, 'register'])->name('events.register');

    // Only admins and organizers can create and delete events
    Route::middleware('role:admin,organizer')->group(function () {
        Route::get('/events/create', [LAEventController::class, 'create'])->name('events.create');
        Route::post('/events', [LAEventController::class, 'store'])->name('events.store');
        Route::delete('/events/{event}', [LAEventController::class, 'destroy'])->name('events.destroy');
    });

    // Edit & update routes accessible to all authenticated users (no role middleware)
    Route::get('/events/{event}/edit', [LAEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [LAEventController::class, 'update'])->name('events.update');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manual logout route
    Route::get('/force-logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    });
});
