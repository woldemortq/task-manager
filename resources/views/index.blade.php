<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Task Manager</h4>
                </div>

                <div class="card-body text-center">
                    <p class="mb-4">
                        Добро пожаловать в систему управления задачами.<br>
                        Войдите в панель, чтобы продолжить работу.
                    </p>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-primary w-100">
                        Войти
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
