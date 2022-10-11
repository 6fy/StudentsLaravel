<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Dashboard</title>
</head>
<body>

<h1>Welcome to your Dashboard, {{ $user->name }}</h1>
<hr />

@if($user->is_admin == 1)
    <a href="/admin">Admin</a>
@else
    <p>You need to be an administrator to access the Admin panel!</p>
@endif
<hr />

<a href="/logout">Logout</a>


</body>
</html>