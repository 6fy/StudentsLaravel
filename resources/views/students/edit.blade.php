<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Edit a student</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">

    @include('includes.header', [
      'mainTitle' => "Edit " . $data['student']->lastname . ", " . $data['student']->firstname, 
      'buttons' => [
        ['title' => "Back to the admin panel", 'href' => "/admin"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">

        <section class="form-holder">
            <form method="post" action="{{ route('editStudent', $data['student']->id) }}" accept-charset="UTF-8">
                @csrf

                <label for="firstname">Student firstname</label>
                <input type="text" name="firstname" placeholder="Enter the students first name" value="{{ $data['student']->firstname }}">

                <span>
                    @error('firstname')
                        {{ $message }}
                    @enderror
                </span>
                <br />

                <label for="lastname">Student lastname</label>
                <input type="text" name="lastname" placeholder="Enter the students last name" value="{{ $data['student']->lastname }}">

                <span>
                    @error('lastname')
                        {{ $message }}
                    @enderror
                </span>
                <br />

                <label for="occupation">Choose an occupation:</label>

                <select id="occupation" name="occupation">
                    <option value="student">Student</option>
                    @if($data['student']->occupation == "teacher")
                        <option value="teacher" selected>Teacher</option>
                    @else
                        <option value="teacher">Teacher</option>
                    @endif
                    @if($data['student']->occupation == "admin")
                        <option value="admin" selected>Administrator</option>
                    @else
                        <option value="admin">Administrator</option>
                    @endif
                </select>
                <br />

                <button type="submit">Confirm edit {{ $data['student']->firstname }}</button>
            </form>
        </section>

    </div>
</div>
@include('includes.footer')

</body>
</html>