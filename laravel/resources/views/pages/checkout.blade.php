@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <!-- info ristorante + form per pagare a sinistra -->
        <div class="col-md-8">
          <div class="info">
            <h1>{{ $user -> restaurant_name }}</h1>

            <div class="">
              FORM DA INSERIRE QUI
            </div>
          </div>
        </div>

        <!-- carrello a destra -->
        <checkout
          :foods="{{$user -> food}}"
          :user_id="'{{$user -> id}}'"
        ></checkout>

    </div> <!-- fine row -->


</div>
@endsection
