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
        $createdTasks = Task::where("status", "created")->get();
        $inworkTasks = Task::where("status", "inwork")->get();
        $onreviewTasks = Task::where("status", "onreview")->get();
        $doneTasks = Task::where("status", "done")->get();
        return [
            "created" => $createdTasks,
            "inwork" => $inworkTasks,
            "onreview" => $onreviewTasks,
            "done" => $doneTasks
        ];
    }

    public function createTask(Request $request) {
        $newTask = Task::create(
            [
                "title" => $request->title,
                "status" => $request->status,
                "number" => 0,
                "notes" => $request->notes
            ]
        );
        return $newTask;
    }
}
