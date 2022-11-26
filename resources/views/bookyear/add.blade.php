<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Add a family</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ url('js/form_helper.js') }}" defer></script>
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')
  
  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Add a bookyear", 
      'buttons' => [
        ['title' => "Back to the bookyear panel", 'href' => "/bookyear"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">

        <section class="form-holder">
            <form method="post" id="form" action="{{ route('addBookyear') }}" accept-charset="UTF-8">
                @csrf

                <label for="year">Year</label>
                <input type="number" name="year" placeholder="Enter the year" value="{{ old('year') }}">

                <span>
                    @error('year')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="contribution">Contribution</label>
                <input type="number" name="contribution" placeholder="Enter the contribution" value="{{ old('contribution') }}">

                <span>
                    @error('contribution')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <button type="submit" id="prevent-duplicate-btn">Add bookyear</button>
            </form>
        </section>

    </div>
</div>
@include('includes.footer')

</body>
</html>