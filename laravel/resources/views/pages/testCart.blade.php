@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
          <!-- Info ristorante -->
          <div class="info">
            <h1>{{ $user -> restaurant_name }} </h1>
            <span>{{ $user -> address }} ° </span>
            <span>Telefono: {{ $user -> phone }}  ° </span>
            <span>Email: {{ $user -> email }}   </span>
          </div>

          <!-- Barra scelta categoria -->
          <nav class="navbar-menu">
            @foreach ($user -> food as $food)
            <span><a href="#">{{ $food -> category }}</a></span>
            @endforeach
          </nav>
        </div> <!-- fine contenitore di sinistra -->

        <!-- Sezione di destra -->
        <div class="col-md-4">
          <!-- Img profilo -->
          <img src="https://www.laghettofonteviva.it/wp-content/uploads/2016/05/pizza-400x250px.jpg" alt="">
        </div>
    </div> <!-- fine row -->

    <!-- cibo e carrello -->
    <food-cart
        :foods="{{$user -> food}}"
        :user_id="'{{$user -> id}}'"
    ></food-cart>

</div>
@endsection
