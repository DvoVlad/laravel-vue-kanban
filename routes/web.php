<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Kanban');
})->name('home');

Route::get('/api/tasks', function () {
    return [
        "created" => [
                [
                    "name" => 'John',
                    "id" => 1
                ]
            ],
        "inwork" => [],
        "onreview" => [],
        "done" => []
    ];
})->name('kanban');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
