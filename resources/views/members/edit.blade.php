<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenadministratie - Edit a family member</title>
    <script src="https://kit.fontawesome.com/a71e7d302d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body>

<div class="app-container">
  @include('includes.sidebar')

  <div class="app-content">
    @include('includes.header', [
      'mainTitle' => "Edit family member " . $data['formattedName'], 
      'buttons' => [
        ['title' => "Back to " . $data['family']->name, 'href' => "/members/" . $data['family']->id], 
        ['title' => "Back to the families", 'href' => "/familie"]
      ]
    ])
    
    <div class="products-area-wrapper tableView">
        <section class="form-holder">
            <form method="post" action="{{ route('editFamilyMember', $data['member']->id) }}" accept-charset="UTF-8">
                @csrf

                <label for="name">Family member name</label>
                <input type="text" name="name" placeholder="Enter the name of the member" value="{{ $data['member']->name }}">

                <span>
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <label for="name">Family member birthdate</label>
                <input type="date" name="birthdate" placeholder="Enter the birth date of the member" value="{{ $data['member']->date_of_birth }}">

                <span>
                    @error('birthdate')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <br />

                <button type="submit">Edit family member</button>
            </form>
        </section>
    </div>
</div>
@include('includes.footer')

</body>
</html>