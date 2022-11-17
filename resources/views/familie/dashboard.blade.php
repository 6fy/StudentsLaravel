<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families - Dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Families", 
      'buttons' => [
        ['title' => "Add a familie", 'href' => "/familie/add"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Id</div>
                <div class="product-cell image">Family name</div>
                <div class="product-cell status-cell">Address</div>
                <div class="product-cell price">Actions</div>
            </div>

              @foreach ($data['families'] as $familie)
                <div class="products-row">
                    <div class="product-cell category">{{ $familie->id }}</div>
                    <div class="product-cell image">
                        <span>{{ $familie->naam }}</span>
                    </div>
                    <div class="product-cell status-cell">{{ $familie->adres }}</div>
                    <div class="product-cell price">
                      <a href="/members/{{ $familie->id }}" title="Family members"><i style="color: white; margin: 5px;" class="fas fa-user"></i></a>
                      <a href="/familie/edit/{{ $familie->id }}" title="Edit family"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                      <a href="{{ route('deleteFamily', $familie->id) }}" title="Delete family"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                    </div>
                </div>
              @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>