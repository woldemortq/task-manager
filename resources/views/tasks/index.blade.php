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

    <a href="https://t.me/task_trackerManager_bot?start=ABC123"
       class="btn btn-telegram d-inline-flex align-items-center gap-2 mb-3"
       target="_blank"
       style="background-color: #1DA1F2; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem;">
        <i class="bi bi-telegram"></i>
        Подключить Telegram
    </a>
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
                    if(data.code){
                        alert('Ваш код для авторизации в Telegram: ' + data.code);
                        // Перенаправляем на бота
                        window.open('https://t.me/task_trackerManager_bot?start=' + data.code, '_blank');
                    } else {
                        alert('Ошибка при генерации кода');
                    }
                });
        });
    </script>

    <p class="text-center mb-5">Создание и просмотр заявок</p>
    <a href="{{route('users.tasks.create')}} "
       class="btn btn-telegram d-inline-flex align-items-center gap-2 mb-3"
       target="_blank"
       style="background-color: #1DA1F2; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem;">
        <i class="bi bi-telegram"></i>
        Создать заявку
    </a>





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
