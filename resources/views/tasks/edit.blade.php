<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit task</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Редактирование задачи</h5>
                </div>

                <div class="card-body">
                    <form
                        action="{{ route('users.tasks.update', $task) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Название</label>
                            <input
                                name="title"
                                type="text"
                                class="form-control"
                                value="{{ old('title', $task->title) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Описание</label>
                            <input
                                name="description"
                                type="text"
                                class="form-control"
                                value="{{ old('description', $task->description) }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Статус</label>
                            <select name="status" class="form-select" required>
                                @foreach($status as $item)
                                    <option
                                        value="{{ $item->value }}"
                                        @selected(old('status', $task->status) === $item->value)
                                    >
                                        {{ $item->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Исполнитель</label>
                            <select
                                name="assigned_to_id"
                                class="form-select"
                                required
                            >
                                <option value="">— Выберите исполнителя —</option>

                                @foreach($users as $user)
                                    <option
                                        value="{{ $user->id }}"
                                        @selected(
                                            old('assigned_to_id', $task->assigned_to_id) == $user->id
                                        )
                                    >
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Обновить задачу
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">
                    ← Вернуться к задачам
                </a>
            </div>
            @if(session('success'))
                <div class="alert alert-success mt-3 text-center">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>

</div>

</body>
</html>
