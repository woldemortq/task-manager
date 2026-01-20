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
        $assignedUser = $task->assignedUser;

        if ($assignedUser && $assignedUser->telegram_chat_id) {
            TelegramService::notify(
                $assignedUser->telegram_chat_id,
                "🆕 Новая задача:\n{$task->title} \n Описание: {$task->description} \n Статус: {$task->status}"
            );
        }
        return view('tasks.create', compact('tasks', 'status'));
    }
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled,in_progress',
            'assigned_to_id' => 'required|exists:users,id',
        ]);

        $oldStatus = $task->status;

        $task->update($data);
        $task->refresh();

        $assignedUser = $task->assignedUser;

        if ($assignedUser && $assignedUser->telegram_chat_id && $oldStatus !== $task->status) {
            TelegramService::notify(
                $assignedUser->telegram_chat_id,
                "🔄 Статус задачи изменён:\n{$task->title}\nНовый статус: {$task->status}"
            );
        }

        return redirect()
            ->route('users.tasks.edit', $task)
            ->with('success', 'Task updated successfully');
    }

    public function editTask(Task $task)
    {
        $status = [
            'pending',
            'in_progress',
            'completed',
            'cancelled',
        ];

        return view('tasks.edit', [
            'task' => $task,
            'status' => $status,
        ]);
    }


}
