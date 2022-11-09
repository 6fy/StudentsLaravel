<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Add a student</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Add a student", 
      'buttons' => [
        ['title' => "Back to the admin panel", 'href' => "/admin"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">

        <section class="form-holder">
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
        </section>

    </div>
</div>
@include('includes.footer')

</body>
</html>