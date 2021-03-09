@extends('layouts.app')

@section('content')
<div class="container">

    <!-- riga con le info del ristorante -->
    <div class="row d-flex align-items-center">

      <a href="{{route('user-show', $user -> id)}}" class="text-center">
        <button class="btn btn-success">&#171; Torna al ristorante</button>
      </a>

      <div class="info">
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
