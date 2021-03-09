@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row">
        <div class="col-md-8 col-s-12">
          <!-- Info ristorante -->
          <div class="info">
            <h1>{{ $user -> restaurant_name }} </h1>
            <span>{{ $user -> address }} ° </span>
            <span>Telefono: {{ $user -> phone }}  ° </span>
            <span>Email: {{ $user -> email }}   </span>
            <h6>Ordina il tuo piatto preferito a casa tua da {{ $user -> restaurant_name }} grazie alla consegna a domicilio di Deliveroo.</h6>
          </div>

          <!-- Barra scelta categoria -->
          {{-- <nav class="navbar-menu">
            @foreach ($user -> food as $food)
            <span><a href="#">{{ $food -> category }}</a></span>
            @endforeach
          </nav> --}}
          <hr>
        </div> <!-- fine contenitore di sinistra -->


        <!-- Sezione di destra -->
        <div class="col-md-4 col-s-12">
          <!-- Img profilo -->
          <div class="img-user">
            <img src="{{ asset('img/user-img/' . $user -> id . '.jpg') }}" alt="">
          </div>
        </div>
    </div> <!-- fine row -->

    <!-- cibo e carrello -->
    <food-cart
        :foods="{{$user -> food}}"
        :user_id="'{{$user -> id}}'"
        :user_name='"{{$user -> restaurant_name}}"'
    ></food-cart>

{{-- </div> --}}
@endsection
