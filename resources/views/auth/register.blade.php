<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Register</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}">
</head>
<body>
    
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="inactive underlineHover"><a style="color: #cccccc;" href="/login">Login</a> </h2>
            <h2 class="active"> Register </h2>

            <!-- Login Form -->
            <form method="post" action="{{ route('registerUser') }}" accept-charset="UTF-8">
                @csrf

                <input type="text" name="name" id="login" class="fadeIn second" placeholder="Enter your name" value="{{ old('name') }}">
                <input type="password" id="login" class="fadeIn third" name="password" placeholder="Enter your password">

                <input type="submit" class="fadeIn fourth" value="Register">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                @if(Session::has('failed'))
                    <p>{{ Session::get('failed') }}</p>
                @endif
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

</body>
</html>