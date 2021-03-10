<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <style>
      .sfondo {
        background-image: url('{{asset('/img/sfondo-home.png')}}');
        background-size: cover;
        background-position: bottom;
        padding: 100px;
      }
      .card {
        background-color: white;
        border-radius: 5px;
        padding: 20px;
      }
    </style>

  </head>
  <body>

    <div class="sfondo">

      <div class="card">

        <h2>

          Riepilogo ordine presso {{$user -> restaurant_name}}:
        </h2>

        <ul>
          @foreach ($cart as $item)
            <li>
              {{$item['quantity']}}x
    
              @foreach ($user -> food as $food)
                @if ($food -> id === $item['id'])
                  {{$food -> name}} -
                  {{$food -> price / 100 * $item['quantity']}} €
                @endif
              @endforeach
              
            </li>
          @endforeach
        </ul>
      </div>

    </div>

  </body>
</html>
