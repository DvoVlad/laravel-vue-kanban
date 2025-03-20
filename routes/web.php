<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
Route::get('/', [TaskController::class, 'getMain'])->name('home');

Route::get('/api/tasks', [TaskController::class, 'getTasks'])->name('kanban');
Route::get('/api/tasks/{id}', [TaskController::class, 'getTask'])->name('task');
Route::post('/api/tasks', [TaskController::class, 'createTask'])->name('task_create');
Route::patch('/api/tasks', [TaskController::class, 'updateTasks'])->name('tasks_update');
Route::put('/api/tasks/{id}', [TaskController::class, 'updateTask'])->name('task_update');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
