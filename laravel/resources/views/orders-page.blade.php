@extends('layouts.main-layout')
@section('content')

    {{-- <div class="row"> --}}

    <h1>Ordini Ricevuti</h1>
    <div>

        @foreach ($foods as $food)

            <comp-order :namefood="'{{ $food->name }}'" :price="{{ $food->price }}"
                :description="'{{ $food->description }}'"></comp-order>

            @foreach ($food->orders as $order)
                <comp-food :nameguest="'{{ $order->name }}'" :email="'{{ $order->email }}'"></comp-food>

            @endforeach

        @endforeach

    </div>

    {{-- </div> --}}

@endsection
