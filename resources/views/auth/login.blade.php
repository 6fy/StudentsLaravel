<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Login</title>
</head>
<body>
    
    <h4>Login</h4>
    <hr />

    @if(Session::has('failed'))
        <p>{{ Session::get('failed') }}</p>
        <hr />
    @endif

    <form method="post" action="{{ route('loginUser') }}" accept-charset="UTF-8">
        @csrf

        <label for="name">Name (username/id)</label>
        <input type="text" name="name" placeholder="Input your name" value="{{ old('name') }}">

        <span>
            @error('name')
                {{ $message }}
            @enderror
        </span>
        <br />

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Input your password">

        <span>
            @error('password')
                {{ $message }}
            @enderror
        </span>
        <br />

        <button type="submit">Login</button>
    </form>

    <hr />
    <a href="/register">New users? Click here.</a>

</body>
</html>