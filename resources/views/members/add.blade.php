<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Add a family member</title>
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
      'mainTitle' => "Add a family member to " . $data['family']->name, 
      'buttons' => [
        ['title' => "Back to " . $data['family']->name, 'href' => "/members/" . $data['family']->id ], 
        ['title' => "Back to the dashboard", 'href' => "/dashboard"]
      ]
    ])

    <div class="products-area-wrapper tableView">

        <section class="form-holder">
            <form method="post" id="form" action="{{ route('addFamilyMember', $data['family']->id) }}" accept-charset="UTF-8">
                @csrf

                <label for="name">Family member name</label>
                <input type="text" name="name" placeholder="Enter the name of the member" value="{{ old('name') }}">

                <span>
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="name">Family member birthdate</label>
                <input type="date" id="date-input" name="birthdate" placeholder="Enter the birth date of the member" value="{{ old('birthdate') }}">

                <span>
                    @error('birthdate')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="type">Family member type</label>
                <p id="help-message"></p>
                <select id="type" name="type">
                    @foreach ($data['types'] as $type)
                        <option value="{{$type['title']}}">{{ $type['description'] }}</option>
                    @endforeach
                </select>
                <br />

                <button type="submit" id="prevent-duplicate-btn">Add family member</button>
            </form>
        </section>

    </div>
</div>
@include('includes.footer')

</body>
</html>