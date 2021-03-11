@extends('layouts.app')

@section('content')
<div class="container">

  {{-- stampo dati del ristoratore per debug --}}
  <div class="display-3   info">
    <h1>{{$userAuth -> restaurant_name}}</h1>
    {{-- <div class="image">
      <img class="img-fluid max-width: 100%" src="{{ asset('/img/user-img/1.jpg')}}" alt="">
    </div> --}}
    {{-- [id {{$userAuth -> id}}] --}}

    <h4><i class="fas fa-cart-arrow-down"></i>  Lista ordini ricevuti</h4>
  </div>

  {{-- stampo tutti gli ordini ricevuti dal ristoratore --}}
  @foreach ($orders as $order)
    <div class="">
      <div class="card order" style="width: 100%;">
        <div class="card-body">
          <h5 class="card-title"> <i class="far fa-sticky-note"></i>  Ordine n° {{$order -> id}}</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong><i class="far fa-calendar"></i> Data Ordine:</strong> {{$order -> date}}</li>
          <li class="list-group-item"><strong><i class="fas fa-coins"></i>  Totale Incassato:</strong> {{$order -> total / 100}} &#8364;</li>
          <li class="list-group-item"><strong><i class="fas fa-pizza-slice"></i>  Piatti ordinati:</strong></li>
          <ul>
            @foreach ($order -> food as $food)
              <li>
                {{-- nella tabella ponte creata dal seed c'é null come quantitá standard, andrebbe fixato il factory --}}
                @if ($food -> pivot -> quantity)
                  {{$food -> pivot -> quantity}}x
                @else
                  1x
                @endif

                {{$food -> name}}
                (id: {{$food -> id}})
                [user-id: {{$food -> user -> id}}]
              </li>
            @endforeach
          </ul>
        </ul>
        </div>
       </div>
      </div>
    </div>
  @endforeach

</div>
@endsection
