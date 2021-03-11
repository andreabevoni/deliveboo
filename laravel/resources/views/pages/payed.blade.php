@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
      <div class="card payed" style="width: 50rem;">
          <div class="card-body">
            <div class="logo">
              <img src="{{asset('img/deliveboo-logo.svg')}}" alt="">
            </div>
            <h2 class="card-title"><i class="fas fa-trophy"></i>  La transazione è avvenuta con successo</h2>
            <h6 class="card-subtitle mb-2 text-muted">Ti ringraziamo per aver scelto il nostro ristorante e i servizi di Deliveboo</h6>
            <p class="card-text">Riceverai una mail di riepilogo del tuo ordine.<br>
            Nel frattempo, il nostro staff sta preparando il tuo ordine, lo riceverai appena possibile grazie alla rete di rider di Deliveboo</p>
            <img src="{{asset('img/rider.png')}}" style="width: 10rem;" alt="">
          </div>
        </div>
    </div>
@endsection
