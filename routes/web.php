<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
Route::get('/', [TaskController::class, 'getMain'])->name('home');

Route::get('/api/tasks', [TaskController::class, 'getTasks'])->name('kanban');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
