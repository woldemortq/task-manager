<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Комментарии к задаче: {{ $task->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4 text-center">Комментарии к задаче: <strong>{{ $task->title }}</strong></h1>

    <div class="text-center mb-4">
        <a href="{{ route('comments.create', $task) }}" class="btn btn-primary">
            ➕ Добавить комментарий
        </a>
    </div>

    @if($comments->isEmpty())
        <div class="alert alert-secondary text-center">
            Комментариев пока нет
        </div>
    @else
        @foreach($comments as $comment)
            <div class="card shadow-sm mb-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                    <div>
                        Автор: <strong>{{ $comment->user->name ?? 'Удалённый пользователь' }}</strong>
                    </div>
                    <div class="text-muted" style="font-size: 0.85rem;">
                        {{ $comment->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $comments->links() }}
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">
            ← Вернуться к задачам
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
