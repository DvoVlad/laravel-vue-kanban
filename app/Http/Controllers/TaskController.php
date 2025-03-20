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
        $createdTasks = Task::where("status", "created")->orderBy("number", "asc")->get();
        $inworkTasks = Task::where("status", "inwork")->orderBy("number", "asc")->get();
        $onreviewTasks = Task::where("status", "onreview")->orderBy("number", "asc")->get();
        $doneTasks = Task::where("status", "done")->orderBy("number", "asc")->get();
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
    public function updateTasks(Request $request) {
        $taskData = $request->data;
        foreach($taskData["created"] as $key => $updatedTask) {
            $task = Task::find($updatedTask["id"]);
            $task->status = "created";
            $task->number = $key;
            $task->save();
        }
        foreach($taskData["inwork"] as $key => $updatedTask) {
            $task = Task::find($updatedTask["id"]);
            $task->status = "inwork";
            $task->number = $key;
            $task->save();
        }
        foreach($taskData["onreview"] as $key => $updatedTask) {
            $task = Task::find($updatedTask["id"]);
            $task->status = "onreview";
            $task->number = $key;
            $task->save();
        }
        foreach($taskData["done"] as $key => $updatedTask) {
            $task = Task::find($updatedTask["id"]);
            $task->status = "done";
            $task->number = $key;
            $task->save();
        }
        return ["ok" => "updated"];
    }
    public function updateTask(Request $request, $id) {
        $editedTask = Task::find($id);
        $editedTask->title = $request->title;
        $editedTask->status = $request->status;
        $editedTask->notes = $request->notes;
        $editedTask->save();
        return $editedTask;
    }
    public function getTask($id) {
        return Task::find($id);
    }
    public function deleteTask($id) {
        $deletedTask = Task::find($id);
        $deletedTask->delete();
        return ["ok" => "deleted ". $id];
    }
}
