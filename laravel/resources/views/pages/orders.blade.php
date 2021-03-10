@extends('layouts.app')

@section('content')
<div class="container">

  {{$userAuth -> restaurant_name}}
  [{{$userAuth -> id}}]

  @php
    dd($orders);
  @endphp

  <ul>
    @foreach ($orders as $order)

      <li>

        {{$order -> id}}

        <ul>
          @foreach ($order -> foodByUser(1) as $food)

            @if ($food -> pivot -> quantity)
              {{$food -> pivot -> quantity}}x
            @else
              1x
            @endif

            {{$food -> name}}
            ({{$food -> id}})
            [{{$food -> user -> id}}]
            <br>

          @endforeach
        </ul>

      </li>

    @endforeach
  </ul>

</div>
@endsection
