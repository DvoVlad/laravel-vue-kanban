<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;

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

    public function createTask(Request $request) {
        return $request->title;
    }
}
