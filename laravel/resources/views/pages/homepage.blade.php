@extends('layouts.app')

@section('content')

  <div class="text-center">
      <div class="display-1">
        Deliveboo
      </div>
      <search :typologies="{{ json_encode($typologies) }}"></search>
  </div>

@endsection
