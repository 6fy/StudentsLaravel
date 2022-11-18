<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Dashboard", 
      'buttons' => [
        ['title' => "Go to families", 'href' => "/familie"]
      ],
      'pageLeader' => "Welcome to your Dashboard, " . $data['user']->name
    ])

    <div class="products-area-wrapper tableView">
        @if ($data['user']->is_admin == 0)
          <div class="white-text">
            <p>Make yourself an admin in the database to continue using the website.</p>
            <p>
              You can achieve this by changing the 0 to a 1
              or by clicking 
              <a href="/makeAdministrator/{{ $data['user']->id }}">
                here
              </a>
              .
            </p>
          </div>
        @else
          <p class="white-text">You are an administrator!</p>
        @endif
    </div>
</div>
@include('includes.footer')

</body>
</html>