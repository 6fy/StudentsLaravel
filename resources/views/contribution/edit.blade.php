<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Edit contribution</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')

  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Edit contribution for " . $data['member']->name, 
      'buttons' => [
        ['title' => "Back to " . $data['member']->name . "'s contribution", 'href' => "/contribution/" . $data['member']->id], 
        ['title' => "Back to the familie panel", 'href' => "/familie"], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])
    
    <div class="products-area-wrapper tableView">
        <section class="form-holder">
            <form method="post" id="form" action="{{ route('editContribution', $data['contribution']->id) }}" accept-charset="UTF-8">
                @csrf
                
                <p class="white-text">Left to pay for {{ $data['member']->name }}: €{{ $data['leftOverContribution'] }}</p>
                <input type="hidden" id="left" name="left" value="{{$data['leftOverContribution']}}">

                <label for="amount">Amount contributed</label>
                <input type="number" id="contribution-amount" name="amount" 
                        placeholder="Enter the amount {{ $data['member']->name }} contributed" value="{{ $data['contribution']->amount }}">

                <span>
                    @error('amount')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="age">Age of {{ $data['member']->name }} when contributed</label>
                <input type="number" name="age" placeholder="Enter the age of {{ $data['member']->name }} when contributed" value="{{ $data['contribution']->age }}">

                <span>
                    @error('age')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="bookyear">Bookyear of the contribution</label>
                <select id="bookyear" name="bookyear">
                    @foreach ($data['bookyears'] as $year)
                        @if (date('Y') == $year->bookyear)
                            <option value="{{ $year->id }}" selected>{{ $year->bookyear }}</option>
                        @else
                            <option value="{{ $year->id }}">{{ $year->bookyear }}</option>
                        @endif
                    @endforeach
                </select>

                <span>
                    @error('bookyear')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <button type="submit" id="prevent-duplicate-btn">Edit Contribution</button>
            </form>
        </section>
    </div>
</div>
@include('includes.footer')

</body>
</html>