@extends('layouts.app')

@section('content')
    <div class="container">

      {{-- stampo dati del ristoratore per debug --}}
      <div class="display-3 info">
        <h1>{{$userAuth -> restaurant_name}}</h1>
        {{-- [id {{$userAuth -> id}}] --}}

        <h4><i class="fas fa-cart-arrow-down"></i>  Lista ordini ricevuti</h4>
      </div>

      {{-- stampo tutti gli ordini ricevuti dal ristoratore --}}
      <order :orders="{{$orders}}"
             :years="{{json_encode($years)}}"
      ></order>

    </div>
@endsection
