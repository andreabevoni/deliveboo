@extends('layouts.app')

@section('content')
<div class="container">

    <!-- riga con le info del ristorante -->
    <div class="checkout-head row d-flex align-items-center">

      <a href="{{route('user-show', $user -> id)}}" class="text-center">
        <button class="btn">&#171; Torna al ristorante</button>
      </a>

      <div class="title">
        <h1>{{ $user -> restaurant_name }}</h1>
      </div>
    </div>

    <!-- riga con form per pagamento e carrello -->
    <checkout
      :foods="{{$user -> food}}"
      :user_id="'{{$user -> id}}'"
    ></checkout>

</div>
@endsection
