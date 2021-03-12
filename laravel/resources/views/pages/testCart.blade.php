@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row p-1 sfondo-info">
        <div class="col-md-8 col-s-12">
          <!-- Info ristorante -->
          <div class="info">
            <h1>{{ $user -> restaurant_name }} </h1>
            <div class="px-4">

              <div><i class="pr-2 fas fa-map-marker-alt"></i> Indirizzo: {{ $user -> address }} </div>
              <div><i class="pr-2 fas fa-phone"></i> Telefono: {{ $user -> phone }} </div>
              <div><i class="pr-2 fas fa-at"></i> Email:  {{ $user -> email }}   </div>
            </div>
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
          <div class="img-user p-4">
            {{-- <img src="{{ asset('storage/icon/' . $user->image) }}" alt=""> --}}
            {{-- <img src="{{ asset('img/user-img/' . $user -> id . '.jpg') }}" alt=""> --}}
            @if ($user->image)
              <img class="img-fluid" src="{{ asset('storage/icon/' . $user->image) }}" alt="">
            @else
              <img class="img-fluid" src="{{ asset('/img/noimg.png') }}" alt="">
            @endif

          </div>
        </div>
    </div> <!-- fine row -->
  </div> <!-- fine container fluid -->


    <!-- cibo e carrello -->
    <food-cart
        :foods="{{$user -> food}}"
        :user_id="'{{$user -> id}}'"
        :user_name='"{{$user -> restaurant_name}}"'
    ></food-cart>

{{-- </div> --}}
@endsection
