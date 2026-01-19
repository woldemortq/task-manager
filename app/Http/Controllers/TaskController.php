<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use App\Service\TelegramService;
use Illuminate\Http\Request;

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

    public function storeTask(Request $request)
    {
        $tasks = Task::all();
        $status = Status::cases();
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled,in_progress',
            'assigned_to_id' => 'required|exists:users,id',
            'creator_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($data);
        $assignedUser = User::find($task->assigned_to_id);

        if ($assignedUser && $assignedUser->telegram_chat_id) {
            TelegramService::notify(
                $assignedUser->telegram_chat_id,
                "🆕 Новая задача:\n{$task->title}"
            );
        }
        return view('tasks.create', compact('tasks', 'status'));
    }
    public function update(Request $request, Task $task)
    {
        $oldStatus = $task->status;

        $task->update($request->only('status', 'title', 'description'));

        if ($request->has('status') && $oldStatus !== $task->status) {
            TelegramService::notify(
                $task->assignedUser->telegram_chat_id,
                "🔄 Статус задачи изменён:\n{$task->title}\nСтатус: {$task->status}"
            );
        }

        return response()->json($task);
    }

}
