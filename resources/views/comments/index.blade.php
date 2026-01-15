<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Комментарии</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4 text-center">Комментарии</h1>

    @if($comments->isEmpty())
        <div class="alert alert-secondary text-center">
            Комментариев пока нет
        </div>
    @else
        <div class="table-responsive">
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

                        <td style="max-width: 400px; word-break: break-word;">
                            {{ $comment->content }}
                        </td>

                        <td>
                            {{ $comment->created_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $comments->links() }}
        </div>
    @endif

</div>

</body>
</html>
