<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }


    public function createTask()
    {
        $tasks = Task::all();
        $status = Status::cases();

        return view('tasks.create', compact('tasks', 'status'));
    }

    public function storeTask()
    {
        $tasks = Task::all();
        $status = Status::cases();
        $task = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'string|in:pending,completed,cancelled,in_progress',
            'assigned_to_id' => 'integer|exists:users,id',
            'creator_id' => 'integer|exists:users,id'
        ]);

        Task::create($task);
        return view('tasks.create', compact('tasks', 'status'));
    }
}
