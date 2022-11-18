<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Family members dashboard</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Family members of " . $data['family']->name, 
      'buttons' => [
        ['title' => "Add a family member", 'href' => "/members/" . $data['family']->id . "/add"], 
        ['title' => "Back to families", 'href' => "/familie"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell category">Member Id</div>
                <div class="product-cell status-cell">Full Name</div>
                <div class="product-cell status-cell">Name</div>
                <div class="product-cell status-cell">Birth date</div>
                <div class="product-cell status-cell">Type</div>
                <div class="product-cell price">Actions</div>
            </div>

              @foreach ($data['members'] as $member)
                <div class="products-row">
                    <div class="product-cell category">{{ $member->id }}</div>
                    <div class="product-cell category">
                      {{ ucfirst($member->name) }} 
                      @if (!str_contains(strtolower($member->name), strtolower($data['family']->name)))
                        {{ ucfirst($data['family']->name) }}
                      @endif
                    </div>
                    <div class="product-cell image">
                        <span>{{ $member->name }}</span>
                    </div>
                    <div class="product-cell image">
                        <span>{{ $member->date_of_birth }}</span>
                    </div>
                    <div class="product-cell status-cell">{{ $data['types']->where('id', $member->lid)->first()->title }}</div>
                    <div class="product-cell price">
                      <a href="/members/edit/{{ $member->id }}" title="Edit family member"><i style="color: white; margin: 5px;" class="fas fa-pencil"></i></a>
                      <a href="{{ route('deleteFamilyMember', $member->id) }}" title="Delete family member"><i style="color: white; margin: 5px;" class="fas fa-trash"></i></a>
                    </div>
                </div>
              @endforeach
        </div>
    </div>
</div>
@include('includes.footer')

</body>
</html>