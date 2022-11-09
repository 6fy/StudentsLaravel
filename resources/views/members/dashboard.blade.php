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
      'mainTitle' => "Family members", 
      'buttons' => [
        ['title' => "Add a family member", 'href' => "/members/add"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Id</div>
                <div class="product-cell image">Family Id</div>
                <div class="product-cell status-cell">Name</div>
                <div class="product-cell status-cell">Birth date</div>
                <div class="product-cell status-cell">Type</div>
                <div class="product-cell price">Actions</div>
            </div>

              @foreach ($data['members'] as $member)
                <div class="products-row">
                    <div class="product-cell category">{{ $member->id }}</div>
                    <div class="product-cell category">{{ $member->familie_id }}</div>
                    <div class="product-cell image">
                        <span>{{ $member->naam }}</span>
                    </div>
                    <div class="product-cell image">
                        <span>{{ $member->geboorte_datum }}</span>
                    </div>
                    <div class="product-cell status-cell">{{ $member->lid }}</div>
                    <div class="product-cell price">
                      <a href="/familie/edit/{{ $member->id }}"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                      <a href="{{ route('deleteFamily', $member->id) }}"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                    </div>
                </div>
              @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>