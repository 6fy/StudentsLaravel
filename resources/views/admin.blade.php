<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
</head>
<body>

<h1>Welcome to your Admin Dashboard, {{ $data['user']->name }}</h1>
<hr />

<a href="/dashboard">Back to dashboard</a>
<hr />

<a href="/student/add">Add a student</a>
<hr />

@if(Session::has('failed'))
    <p>{{ Session::get('failed') }}</p>
    <hr />
@endif

<h1>Students:</h1>
<table border="1px solid black;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Occupation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($data['students'] as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->firstname }}</td>
                <td>{{ $student->lastname }}</td>
                <td>{{ $student->occupation }}</td>
                <td>
                    <a href="/student/edit/{{ $student->id }}"><i style="color: black; margin: 5px;" class="fas fa-pencil"></i></a>
                    <a href="{{ route('deleteStudent', $student->id) }}"><i style="color: black; margin: 5px;" class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

</body>
</html>