<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div>
    Это админ панель, вы вошли!
</div>
<div>
    <form action="{{ route('admin.create.users') }}" method="post">
        @csrf
        <div class="container" >
            <div class="form-group mt-3">
                <label for="username">Username</label>
                <input name="name" type="text" class="form-control" id="username" placeholder="Enter username">
            </div>
            <div class="form-group mt-3">
                <label for="email">email</label>
                <input name="email" type="text" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="roleSelect">Role</label>
                <select class="form-control selectpicker" id="roleSelect" name="role"
                        data-live-search="true" title="Выберите роль...">
                    @foreach($roles as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        <button type="submit" class="btn btn-primary mt-3" >Create user</button>
        </div>
    </form>
    <div>
        @foreach($users as $user)
            {{$user->name}}, {{$user->email}}
        @endforeach
    </div>
    <div>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
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

</body>
</html>
