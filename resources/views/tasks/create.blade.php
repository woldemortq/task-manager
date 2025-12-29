<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('users.tasks.create') }}" method="POST">
    @csrf
    <div class="container" >
        <div class="form-group mt-3">
            <label for="title">title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter title">
        </div>
        <div class="form-group mt-3">
            <label for="description">description</label>
            <input name="description" type="text" class="form-control" id="description" placeholder="Enter description">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control selectpicker" id="status" name="status"
                    data-live-search="true" title="Выберите роль...">
                @foreach($status as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group mt-3">
            <label for="creator_id">creator_id</label>
            <input name="creator_id" type="text" class="form-control" id="creator_id" placeholder="Enter creator_id">
        </div>
        <div class="form-group mt-3">
            <label for="assigned_to_id">assigned_to_id</label>
            <input name="assigned_to_id" type="text" class="form-control" id="assigned_to_id" placeholder="Enter assigned_to_id">
        </div>
        <button type="submit" class="btn btn-primary mt-3" >Create task</button>
    </div>
</form>
<div>
    @foreach($tasks as $task)
        {{$task->title}}, {{$task->description}}
    @endforeach
</div>

</body>
</html>
