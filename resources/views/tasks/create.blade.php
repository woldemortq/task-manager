<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Create task</title>

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Создание задачи</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.tasks.create') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Название</label>
                            <input
                                name="title"
                                type="text"
                                class="form-control"
                                id="title"
                                placeholder="Введите название задачи"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <input
                                name="description"
                                type="text"
                                class="form-control"
                                id="description"
                                placeholder="Введите описание задачи"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Статус</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">— Выберите статус —</option>

                                @foreach($status as $item)
                                    <option value="{{ $item->value }}">
                                        {{ $item->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="creator_id" class="form-label">Создал задачу</label>
                            <select
                                name="creator_id"
                                id="creator_id"
                                class="form-select"
                                required
                            >
                                <option value="">— Выберите создателя —</option>

                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="assigned_to_id" class="form-label">Исполнитель</label>
                            <select
                                name="assigned_to_id"
                                id="assigned_to_id"
                                class="form-select"
                                required
                            >
                                <option value="">— Выберите исполнителя —</option>

                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary w-100">
                            Создать задачу
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
