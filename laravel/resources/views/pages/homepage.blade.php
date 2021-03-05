@extends('layouts.app')

@section('content')

  <div class="text-center">
      <div class="sfondo">
        <h1 class="display-1">
          DELIVEBOO
        </h1>
      </div>
      <search :typologies="{{ json_encode($typologies) }}"></search>
  </div>

@endsection
