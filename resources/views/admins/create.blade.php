<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Админ: пользователи</title>

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4 text-center">Админ: Управление пользователями</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            <h5 class="mb-2">{{ session('success') }}</h5>

            <p class="mb-1">
                <strong>Имя:</strong> {{ session('user_name') }}
            </p>

            <p class="mb-0">
                <strong>Email:</strong> {{ session('user_email') }}
            </p>
        </div>
    @endif


    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Форма создания пользователя --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Создать нового пользователя</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.create.users') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                name="name"
                                type="text"
                                class="form-control"
                                id="username"
                                placeholder="Введите username"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control"
                                id="email"
                                placeholder="Введите email"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control"
                                id="password"
                                placeholder="Введите пароль"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="roleSelect" class="form-label">Роль</label>
                            <select
                                class="form-select"
                                id="roleSelect"
                                name="role"
                            >
                                @foreach($roles as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Создать пользователя
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- Список пользователей --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Список пользователей</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
