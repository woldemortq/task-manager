<?php

namespace App\Http\Controllers;

use App\Models\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comments::with(['user', 'task'])
            ->latest()
            ->paginate(20);

        return view('comments.index', compact('comments'));
    }
}
