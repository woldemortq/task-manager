<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Вход в панель задач</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Войти в панель задач</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Логин или Email</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Введите логин или email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Введите пароль"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Войти
                        </button>
                    </form>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-danger mt-3 text-center">
                    {{ session('error') }}
                </div>
            @endif

        </div>
    </div>

</div>

</body>
</html>
