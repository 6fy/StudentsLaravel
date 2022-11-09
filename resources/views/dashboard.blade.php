<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Dashboard</title>
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
        ['title' => "Admin", 'href' => "/admin"]
      ],
      'pageLeader' => "Welcome to your Dashboard, " . $data['user']->name
    ])

    <div class="products-area-wrapper tableView">
        <p class="white-text">There is no information to be displayed here.</p>
        @if($data['user']->is_admin == 0)
            <p class="white-text">Make yourself an admin in the database to continue using the website.</p>
        @endif
    </div>
</div>
@include('includes.footer')

</body>
</html>