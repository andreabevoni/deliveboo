@extends('layouts.app')

@section('content')

  <div class="hero text-center">
    <div class="container-hp">
      <div class="display-1">
        <div class="main-logo">
          <img src="{{ asset('img/deliveboo-logo-white.svg')}}" alt="">
        </div>
        <div class="main-headline">
          <h1>I piatti che ami, a domicilio.</h1>
          <h3>Cerchi qualcosa?</h3>
        </div>
      </div>
      <search :typologies="{{ json_encode($typologies) }}"></search>
    </div>
  </div>

@endsection
