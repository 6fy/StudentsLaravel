<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Add a student</title>
</head>
<body>

    <h1>Add a student</h1>
    <hr />

    @if(Session::has('failed'))
        <p>{{ Session::get('failed') }}</p>
        <hr />
    @endif
    
    <form method="post" action="{{ route('addStudent') }}" accept-charset="UTF-8">
        @csrf

        <label for="firstname">Student firstname</label>
        <input type="text" name="firstname" placeholder="Enter the students first name" value="{{ old('firstname') }}">

        <span>
            @error('firstname')
                {{ $message }}
            @enderror
        </span>
        <br />

        <label for="lastname">Student lastname</label>
        <input type="text" name="lastname" placeholder="Enter the students last name" value="{{ old('lastname') }}">

        <span>
            @error('lastname')
                {{ $message }}
            @enderror
        </span>
        <br />

        <label for="occupation">Choose an occupation:</label>

        <select id="occupation" name="occupation">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Administrator</option>
        </select>
        <br />

        <button type="submit">Add student</button>
    </form>

    <a href="/admin">Go back to the Admin panel</a>
</body>
</html>