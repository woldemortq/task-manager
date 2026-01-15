<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Tasks Dashboard</title>

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4 text-center">Главная страница для пользователей</h1>
    <p class="text-center mb-5">Создание и просмотр заявок</p>

    @forelse($tasks as $task)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <strong>{{ $task->id }}. {{ $task->title }}</strong>
                <span class="badge bg-secondary float-end">{{ $task->status }}</span>
            </div>

            <div class="card-body">
                <p>{{ $task->description }}</p>

                @if($task->comments->count())
                    <hr>
                    <h6>Комментарии:</h6>
                    @foreach($task->comments as $comment)
                        <div class="border rounded p-2 mb-2 bg-light">
                            <strong>{{ $comment->user->name }}</strong>
                            <p class="mb-0">Коммент к задаче <strong>{{ $task->title }}:</strong> <br>
                                {{ $comment->content }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Комментариев пока нет</p>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Нет задач</p>
    @endforelse

</div>

</body>
</html>
