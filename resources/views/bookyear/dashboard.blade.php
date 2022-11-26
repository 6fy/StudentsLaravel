<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Bookyear dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Manage Bookyears", 
      'buttons' => [
        ['title' => "Add bookyear", 'href' => "/bookyear/add"],
        ['title' => "Back to all dashboard", 'href' => "/dashboard"],
        ['title' => "Back to all families", 'href' => "/familie"]
      ]
    ])

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Id</div>
                <div class="product-cell status-cell">Book Year</div>
                <div class="product-cell status-cell">Contribution</div>
                <div class="product-cell status-cell">Actions</div>
            </div>

            @foreach ($data['bookyear'] as $year)
              <div class="products-row">
                  <div class="product-cell category">{{ $year->id }}</div>
                  <div class="product-cell status-cell">{{ $year->bookyear }}</div>
                  <div class="product-cell image">
                      <span>€{{ $year->contribution }}</span>
                  </div>
                  <div class="product-cell price">
                    <a href="/bookyear/edit/{{ $year->id }}" title="Edit bookyear"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                    <a href="{{ route('deleteBookyear', $year->id) }}" title="Delete bookyear"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>