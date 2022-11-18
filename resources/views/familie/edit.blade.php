<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Edit a family</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')

  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Edit family: " . $data['family']->name, 
      'buttons' => [
        ['title' => "Back to the familie panel", 'href' => "/familie"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])
    
    <div class="products-area-wrapper tableView">
        <section class="form-holder">
            <form method="post" action="{{ route('editFamily', $data['family']->id) }}" accept-charset="UTF-8">
                @csrf

                <label for="name">Family name</label>
                <input type="text" name="name" placeholder="Enter the family name" value="{{ $data['family']->name }}">

                <span>
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="address">Family address</label>
                <input type="address" name="address" placeholder="Enter the address" value="{{ $data['family']->address }}">

                <span>
                    @error('address')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <button type="submit">Edit family</button>
            </form>
        </section>
    </div>
</div>
@include('includes.footer')

</body>
</html>