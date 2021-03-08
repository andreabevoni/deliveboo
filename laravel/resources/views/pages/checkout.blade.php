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

    <div id="dropin-container"></div>

</div>
@endsection

{{-- @php
  $path = base_path();
  require_once $path . '/braintree/lib/Braintree.php';
  $gateway = new \Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'hgvcd7wdfvcgzx7h',
    'publicKey' => 'pnx3pfrwprvcnhxd',
    'privateKey' => 'cd2d8ffc57f426d67fc3af282a183dd5'
  ]);
  $clientToken = $gateway->clientToken()->generate();
@endphp --}}

{{-- <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script> --}}

{{-- <script type="text/javascript">
  braintree.dropin.create({
    container: document.getElementById('dropin-container'),
    authorization: this.clientToken,
    container: '#dropin-container'
  }, (error, dropinInstance) => {
  });
</script> --}}
