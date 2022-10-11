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
  <div class="sidebar">
    <ul class="sidebar-list">
      <li class="sidebar-list-item">
        <a href="/dashboard">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="/admin">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          <span>Students</span>
        </a>
      </li>
    </ul>
    <div class="account-info">
      <div class="account-info-picture">
        <img src="https://images.unsplash.com/photo-1527736947477-2790e28f3443?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTE2fHx3b21hbnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" alt="Account">
      </div>
      <div class="account-info-name">{{ $data['user']->name }}</div>
      <button class="account-info-more">
        <i style="margin-right: 10px; cursor: pointer;" class="fa-solid fa-arrow-right-from-bracket"></i>
      </button>
    </div>
  </div>
  <div class="app-content">
    <div class="app-content-header">
      <h1 class="app-content-headerText">Edit {{ $data['student']->lastname }}, {{ $data['student']->firstname }}</h1>
      <section>
      <a class="home-btn" href="/admin">
            <button class="app-content-headerButton">Back to the admin panel</button>
        </a>
        <a class="home-btn" href="/dashboard">
            <button class="app-content-headerButton">Back to the dashboard</button>
        </a>
      </section>
    </div>
    <div class="app-content-actions">
        @if(Session::has('failed'))
            <section style="color: white; font-size: 15px;">
                <p>{{ Session::get('failed') }}</p>
                <hr />
            </section>
        @endif
      <div class="app-content-actions-wrapper"></div>
    </div>

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
<div class="footer">
    <p>This is a footer</p>
</div>

</body>
</html>