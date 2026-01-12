<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Комментарии</h1>

        @if($comments->isEmpty())
            <div class="alert alert-secondary">
                Комментариев пока нет
            </div>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Задача</th>
                    <th>Автор</th>
                    <th>Комментарий</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>

                        <td>
                            <a href="{{ route('tasks.index', $comment->task->id) }}">
                                {{ $comment->task->title ?? '—' }}
                            </a>
                        </td>

                        <td>
                            {{ $comment->user->name ?? 'Удалённый пользователь' }}
                        </td>

                        <td style="max-width: 400px;">
                            {{ $comment->content }}
                        </td>

                        <td>
                            {{ $comment->created_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $comments->links() }}
        @endif
    </div>
</body>
</html>
