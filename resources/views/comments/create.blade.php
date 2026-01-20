<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Добавить комментарий к задаче: {{ $task->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4 text-center">Добавить комментарий к задаче: <strong>{{ $task->title }}</strong></h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Новый комментарий
                </div>

                <div class="card-body">
                    <form action="{{ route('comments.store', $task) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="content" class="form-label">Комментарий</label>
                            <textarea
                                name="content"
                                id="content"
                                class="form-control"
                                rows="4"
                                placeholder="Введите текст комментария"
                                required
                            ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Добавить комментарий
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('tasks.index', $task) }}" class="btn btn-outline-secondary">
                    ← Вернуться к комментариям
                </a>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
