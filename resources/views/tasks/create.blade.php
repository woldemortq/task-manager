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

            {{-- Form card --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create task</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.tasks.create') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                name="title"
                                type="text"
                                class="form-control"
                                id="title"
                                placeholder="Enter title"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input
                                name="description"
                                type="text"
                                class="form-control"
                                id="description"
                                placeholder="Enter description"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select
                                class="form-select"
                                id="status"
                                name="status"
                            >
                                @foreach($status as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="creator_id" class="form-label">Creator ID</label>
                            <input
                                name="creator_id"
                                type="number"
                                class="form-control"
                                id="creator_id"
                                placeholder="Enter creator id"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="assigned_to_id" class="form-label">Assigned to ID</label>
                            <input
                                name="assigned_to_id"
                                type="number"
                                class="form-control"
                                id="assigned_to_id"
                                placeholder="Enter assigned user id"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Create task
                        </button>
                    </form>
                </div>
            </div>

            {{-- Tasks list --}}
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Tasks</h5>
                </div>

                <ul class="list-group list-group-flush">
                    @forelse($tasks as $task)
                        <li class="list-group-item">
                            <strong>{{ $task->title }}</strong>
                            <div class="text-muted small">
                                {{ $task->description }}
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">
                            No tasks yet
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>

</div>

</body>
</html>
