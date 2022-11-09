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
      'mainTitle' => "Edit family: " . $data['family']->naam, 
      'buttons' => [
        ['title' => "Back to the familie panel", 'href' => "/familie"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])
    
    <div class="products-area-wrapper tableView">
        
    </div>
</div>
@include('includes.footer')

</body>
</html>