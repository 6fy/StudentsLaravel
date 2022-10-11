<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Edit a student</title>
</head>
<body>

    <h1>Edit {{ $student->lastname }}, {{ $student->firstname }}</h1>
    <hr />

    @if(Session::has('failed'))
        <p>{{ Session::get('failed') }}</p>
        <hr />
    @endif
    
    <form method="post" action="{{ route('editStudent', $student->id) }}" accept-charset="UTF-8">
        @csrf

        <label for="firstname">Student firstname</label>
        <input type="text" name="firstname" placeholder="Enter the students first name" value="{{ $student->firstname }}">

        <span>
            @error('firstname')
                {{ $message }}
            @enderror
        </span>
        <br />

        <label for="lastname">Student lastname</label>
        <input type="text" name="lastname" placeholder="Enter the students last name" value="{{ $student->lastname }}">

        <span>
            @error('lastname')
                {{ $message }}
            @enderror
        </span>
        <br />

        <label for="occupation">Choose an occupation:</label>

        <select id="occupation" name="occupation">
            <option value="student">Student</option>
            @if($student->occupation == "teacher")
                <option value="teacher" selected>Teacher</option>
            @else
                <option value="teacher">Teacher</option>
            @endif
            @if($student->occupation == "admin")
                <option value="admin" selected>Administrator</option>
            @else
                <option value="admin">Administrator</option>
            @endif
        </select>
        <br />

        <button type="submit">Confirm edit {{ $student->firstname }}</button>
    </form>

    <a href="/admin">Go back to the Admin panel</a>
</body>
</html>