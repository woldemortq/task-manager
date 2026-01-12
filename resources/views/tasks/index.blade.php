<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

Это будет главная страница для пользователей для создания заявок
<div>
    @foreach($tasks as $task)
        <hr>
        {{$task->id}}. {{$task->title}} <br>

        {{$task->description}} <br>
        {{$task->status}} <br>
        <hr>
        <br>
    @endforeach
    @foreach($task->comments as $comment)
        <p>
            <strong>{{ $comment->user->name }}</strong> <br>
            <p>Коммент к задаче <strong>{{$task->title}}:</strong> <br> {{ $comment->content }}</p>
        </p>
    @endforeach
</div>
</body>
</html>
