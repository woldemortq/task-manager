<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Comments;
use App\Models\Task;
use App\Models\User;
use App\Service\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index(Task $task)
    {
        $comments = $task->comments()->with('user')->paginate(5);
        return view('comments.index', compact('task', 'comments'));
    }
    public function createComment(Task $task)
    {
        return view('comments.create', compact('task'));
    }

    public function storeComment(Request $request, Task $task)
    {
        $currentCommentator = Auth::user();

        $data = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $comment = $task->comments()->create([
            'user_id' => $currentCommentator->id,
            'content' => $data['content'],
        ]);

        $assignedUser = $task->assignedUser;

        if ($assignedUser && $assignedUser->telegram_chat_id) {
            TelegramService::notify(
                $assignedUser->telegram_chat_id,
                "💬 Новый комментарий к задаче '{$task->title}':\n{$comment->content}"
            );
        }

        return redirect()->route('tasks.index', $task)->with('success', 'Комментарий добавлен');
    }
}
