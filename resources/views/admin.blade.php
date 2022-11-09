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
      'mainTitle' => "Students", 
      'buttons' => [
        ['title' => "Add a student", 'href' => "/student/add"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])
    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Id</div>
                <div class="product-cell image">Occupation</div>
                <div class="product-cell status-cell">Firstname</div>
                <div class="product-cell price">Lastname</div>
                <div class="product-cell price">Actions</div>
            </div>

            @foreach ($data['students'] as $student)
                <div class="products-row">
                    <div class="product-cell category">{{ $student->id }}</div>
                    <div class="product-cell image">
                        @if($student->occupation == "student")
                            <i style="margin-right: 10px;" class="fa-solid fa-graduation-cap"></i>
                        @elseif($student->occupation == "teacher")
                            <i style="margin-right: 10px;" class="fa-solid fa-user"></i>
                        @elseif($student->occupation == "admin")
                            <i style="margin-right: 10px;" class="fa-solid fa-shield"></i>
                        @endif
                        <span>{{ $student->occupation }}</span>
                    </div>
                    <div class="product-cell status-cell">{{ $student->firstname }}</div>
                    <div class="product-cell price">{{ $student->lastname }}</div>
                    <div class="product-cell price">
                        <a href="/student/edit/{{ $student->id }}"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                        <a href="{{ route('deleteStudent', $student->id) }}"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>