<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Contribution dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Contribution of " . $data['formattedName'], 
      'buttons' => [
        ['title' => "Add contribution for " . $data['formattedName'], 'href' => "/contribution/add/" . $data['member']->id], 
        ['title' => "Back to " . $data['family']->name, 'href' => "/members/" . $data['family']->id], 
        ['title' => "Back to all families", 'href' => "/familie"]
      ]
    ])

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Id</div>
                <div class="product-cell image">Contribution Amount</div>
                <div class="product-cell status-cell">Book Year</div>
                <div class="product-cell status-cell">Age</div>
                <div class="product-cell price">Actions</div>
            </div>

            @foreach ($data['contribution'] as $con)
              <div class="products-row">
                  <div class="product-cell category">{{ $con->id }}</div>
                  <div class="product-cell image">
                      <span>€{{ $con->amount }}</span>
                  </div>
                  <div class="product-cell status-cell">{{ $data['bookyears']->where('id', $con->bookyear_id)->first()['bookyear'] }}</div>
                  <div class="product-cell status-cell">{{ $con->age }}</div>
                  <div class="product-cell price">
                    <a href="/contribution/edit/{{ $con->id }}" title="Edit contribution"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                    <a href="{{ route('deleteContribution', $con->id) }}" title="Delete contribution"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>