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
                    <h5 class="mb-0">Edit task</h5>
                </div>

                <div class="card-body">
                    <form
                        action="{{ route('users.tasks.update', $task) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input
                                name="title"
                                type="text"
                                class="form-control"
                                value="{{ old('title', $task->title) }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input
                                name="description"
                                type="text"
                                class="form-control"
                                value="{{ old('description', $task->description) }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select
                                name="status"
                                class="form-select"
                            >
                                @foreach($status as $value)
                                    <option
                                        value="{{ $value }}"
                                        @selected($task->status === $value)
                                    >
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assigned to ID</label>
                            <input
                                name="assigned_to_id"
                                type="number"
                                class="form-control"
                                value="{{ old('assigned_to_id', $task->assigned_to_id) }}"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Update task
                        </button>
                    </form>
                </div>
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
