@extends('layouts.app')
@section('content')

    {{-- <div class="row"> --}}
    <div class="row d-flex justify-content-around py-4">

        <h1>Ordini Ricevuti</h1>
    </div>

    <div>
        {{-- @php
            dd($order);
        @endphp --}}

        {{-- @foreach ($order as $food)

            <comp-order :namefood="'{{ $food->name }}'" :price="{{ $food->price }}"
                :description="'{{ $food->description }}'"></comp-order>

            @foreach ($food->orders as $order)
                <comp-food :nameguest="'{{ $order->name }}'" :email="'{{ $order->email }}'"></comp-food>

            @endforeach

        @endforeach --}}

    </div>

@endsection
