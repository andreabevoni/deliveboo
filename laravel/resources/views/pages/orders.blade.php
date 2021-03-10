@extends('layouts.app')

@section('content')
<div class="container">

  {{-- stampo dati del ristoratore per debug --}}
  <div class="display-3">
    {{$userAuth -> restaurant_name}}
    [id {{$userAuth -> id}}]
  </div>

  {{-- stampo tutti gli ordini ricevuti dal ristoratore --}}
  @foreach ($orders as $order)
    <div class="border border-primary mb-4">

      <h5 class="">Ordine numero {{$order -> id}}</h5>

      <div class="">Data Ordine: {{$order -> date}}</div>

      <div class="">Totale Incassato: {{$order -> total / 100}} &#8364;</div>

      <div class="">
        Cibo Ordinato:
        @foreach ($order -> food as $food)
          <div class="">
            {{-- nella tabella ponte creata dal seed c'é null come quantitá standard, andrebbe fixato il factory --}}
            @if ($food -> pivot -> quantity)
              {{$food -> pivot -> quantity}}x
            @else
              1x
            @endif

            {{$food -> name}}
            ({{$food -> id}})
            [{{$food -> user -> id}}]
          </div>
        @endforeach
      </div>

    </div>
  @endforeach

</div>
@endsection
