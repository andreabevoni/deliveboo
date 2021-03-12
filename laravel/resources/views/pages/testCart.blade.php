@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row">
        <div class="col-md-8 col-s-12">
          <!-- Info ristorante -->
          <div class="info">
            <h1>{{ $user -> restaurant_name }} </h1>
            <span><i class="fas fa-map-marker-alt"></i> Indirizzo: {{ $user -> address }} </span>
            <span><i class="fas fa-phone"></i> Telefono: {{ $user -> phone }} </span>
            <span><i class="fas fa-at"></i> Email:  {{ $user -> email }}   </span>
            <h6>Ordina il tuo piatto preferito a casa tua da <strong> {{ $user -> restaurant_name }} </strong> grazie alla consegna a domicilio di Deliveboo.</h6>
          </div>

          <!-- Barra scelta categoria -->
          {{-- <nav class="navbar-menu">
            @foreach ($user -> food as $food)
            <span><a href="#">{{ $food -> category }}</a></span>
            @endforeach
          </nav> --}}
        </div> <!-- fine contenitore di sinistra -->


        <!-- Sezione di destra -->
        <div class="col-md-4 col-s-12">
          <!-- Img profilo -->
          <div class="img-user">
            <img src="{{ asset('storage/icon/' . $user->image) }}" alt="">
            {{-- <img src="{{ asset('img/user-img/' . $user -> id . '.jpg') }}" alt=""> --}}
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
