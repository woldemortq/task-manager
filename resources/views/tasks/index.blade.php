<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">Главная страница</h1>

    <div class="text-center mb-4">
        <a href="https://t.me/task_trackerManager_bot?start=ABC123"
           class="btn btn-telegram d-inline-flex align-items-center gap-2 mb-3"
           target="_blank"
           style="background-color: #1DA1F2; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem;">
            Подключить Telegram
        </a>
    </div>

    <script>
        document.querySelector('.btn-telegram').addEventListener('click', function(e) {
            e.preventDefault();
            fetch("{{ route('telegram.generate') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code) {
                        alert('Ваш код для авторизации в Telegram: ' + data.code);
                        window.open('https://t.me/task_trackerManager_bot?start=' + data.code, '_blank');
                    } else {
                        alert('Ошибка при генерации кода');
                    }
                });
        });
    </script>

    <p class="text-center mb-4">Создание и просмотр заявок</p>

    <div class="text-center mb-4">
        <a href="{{ route('users.tasks.create') }}" class="btn btn-primary">
            ➕ Создать заявку
        </a>
    </div>

    @php
        $tasks = $tasks->sortBy('id');
    @endphp

    @forelse($tasks as $task)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $task->id }}. {{ $task->title }}</strong>
                    <span class="badge bg-secondary ms-2">
            {{ \App\Enums\Status::from($task->status)->label() }}
        </span>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('users.tasks.edit', $task) }}" class="btn btn-sm btn-outline-light">
                        ✏️ Редактировать
                    </a>

                    <a href="{{ route('users.comments', $task) }}" class="btn btn-sm btn-outline-warning">
                        💬 Комментарии
                    </a>

                    <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $task->id }}">
                        🗑 Удалить
                    </button>
                </div>
            </div>


            <div class="card-body">
                <p>{{ $task->description }}</p>

                @if($task->comments->count())
                    <hr>
                    <h6>Комментарии:</h6>
                    @foreach($task->comments as $comment)
                        <div class="border rounded p-2 mb-2 bg-light">
                            <strong>{{ $comment->user->name }}</strong>
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Комментариев пока нет</p>
                @endif
            </div>
        </div>

        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Удаление задачи</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Вы действительно хотите удалить задачу
                        <strong>«{{ $task->title }}»</strong>?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>

                        <form action="{{ route('users.tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Да, удалить</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <p class="text-center text-muted">Нет задач</p>
    @endforelse

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
