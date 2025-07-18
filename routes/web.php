<?php

use App\Http\Controllers\LAEventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect based on authentication
Route::get('/', function () {
    return auth()->check() ? redirect()->route('events.index') : redirect()->route('login');
});

// Guest routes (login, register, etc.)
Route::middleware('guest')->group(function () {
    require __DIR__ . '/auth.php';
});

// Authenticated user routes
Route::middleware('auth')->group(function () {

    // Event creation and submission (open to all authenticated users)
    Route::get('/events/create', [LAEventController::class, 'create'])->name('events.create');
    Route::post('/events', [LAEventController::class, 'store'])->name('events.store');

    // Event listing, details, registration (available to all logged-in users)
    Route::get('/events', [LAEventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [LAEventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/register', [LAEventController::class, 'register'])->name('events.register');

    // Event editing and updating (open to all authenticated users)
    Route::get('/events/{event}/edit', [LAEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [LAEventController::class, 'update'])->name('events.update');

    // Event deletion (restricted to admin and organizer roles)
    Route::middleware('role:admin,organizer')->group(function () {
        Route::delete('/events/{event}', [LAEventController::class, 'destroy'])->name('events.destroy');
    });

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manual logout
    Route::get('/force-logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    });
});
