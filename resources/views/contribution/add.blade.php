<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Add contribution</title>
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
      'mainTitle' => "Add contribution for " . $data['member']->name, 
      'buttons' => [
        ['title' => "Back to " . $data['member']->name . "'s contribution", 'href' => "/contribution/" . $data['member']->id], 
        ['title' => "Back to the familie panel", 'href' => "/familie"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">

        <section class="form-holder">
            <form method="post" id="form" action="{{ route('addContribution', $data['member']->id) }}" accept-charset="UTF-8">
                @csrf

                <label for="amount">Amount contributed</label>
                <input type="number" name="amount" placeholder="Enter the amount {{ $data['member']->name }} contributed" value="{{ old('amount') }}">

                <span>
                    @error('amount')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <button type="submit" id="prevent-duplicate-btn">Add Contribution</button>
            </form>
        </section>

    </div>
</div>
@include('includes.footer')

</body>
</html>