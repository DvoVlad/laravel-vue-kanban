<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function getMain() {
        return Inertia::render('Kanban');
    }

    public function getTasks() {
        return [
            "created" => [
                    [
                        "title" => 'John',
                        "id" => 1
                    ]
                ],
            "inwork" => [],
            "onreview" => [],
            "done" => []
        ];
    }
}
