@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">

      {{-- stampo dati del ristoratore per debug --}}
      <div class="display-3 info">
        <h1>{{$userAuth -> restaurant_name}}</h1>
        {{-- [id {{$userAuth -> id}}] --}}

        <h4><i class="fas fa-cart-arrow-down"></i>  Lista ordini ricevuti</h4>
      </div>

  <button type="button" name="button" class="btn-order">
    <i class="fas fa-chart-bar"></i>
    Visualizza statistiche ordini
  </button>
      <div class="col-sm-12">

        @php
            $ordini = 0;
        @endphp
        {{-- stampo tutti gli ordini ricevuti dal ristoratore --}}
        @foreach ($orders as $order)
          @php
              $ordini = 1;
          @endphp
          <div class="card order">
            <div class="card-body">
              <h5 class="card-title"> <i class="far fa-sticky-note"></i>  Ordine n° {{$order -> id}}</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong><i class="far fa-calendar"></i> Data Ordine:</strong> {{$order -> date}}</li>
              <li class="list-group-item"><strong><i class="fas fa-coins"></i>  Totale Incassato:</strong> {{$order -> total / 100}} &#8364;</li>
              <li class="list-group-item"><strong><i class="fas fa-pizza-slice"></i>  Piatti ordinati:</strong>
                @foreach ($order -> food as $food)
                  <span>
                    {{-- nella tabella ponte creata dal seed c'é null come quantitá standard, andrebbe fixato il factory --}}
                    @if ($food -> pivot -> quantity)
                      {{$food -> pivot -> quantity}}x
                    @else
                      1x
                    @endif

                    @if ($loop->last)
                      {{$food -> name}}
                    @else
                      {{$food -> name}} - 
                    @endif

                  </span>
                @endforeach
              </li>
            </ul>
            </div>
          </div>
        @endforeach

      </div>


      @if ($ordini == 1)

      @else
          <div class="col-sm-12">
            <div class="col-sm-10 col-md-6 mx-auto">

              <img class="img-fluid" src="{{asset('/img/no-orders.jpg')}}" alt="">
            </div>
            <h2 class="text-center py-5">
              Non hai ricevuto nessun ordine
            </h2>
          </div>
      @endif
    </div>

  </div>

@endsection
