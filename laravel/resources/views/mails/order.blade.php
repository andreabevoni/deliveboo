<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    Riepilogo ordine presso {{$user -> restaurant_name}}:

    <ul>
      @foreach ($cart as $item)
        <li>
          {{$item['quantity']}}x

          @foreach ($user -> food as $food)
            @if ($food -> id === $item['id'])
              {{$food -> name}}
            @endif
          @endforeach
        </li>
      @endforeach
    </ul>

  </body>
</html>
