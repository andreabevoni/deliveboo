@extends('layouts.main-layout')
@section('content')

    {{-- <div class="row"> --}}
        <div class="row d-flex justify-content-around py-4">

            <h2>Foods</h2>
            <button class="btn btn-warning">
                <a href="{{route('create-food')}}">

                    Aggiungi
                </a>
            </button>
        </div>
        <div>

            @foreach ($foods as $food)

                <comp-food
                    :namefood= "'{{$food -> name}}'"
                    :price= "{{$food -> price}}"
                    :description= "'{{$food -> description}}'"
                ></comp-food>
            
                {{-- @foreach ($food -> orders as $order)
                    <comp-food
                        :nameguest= "'{{$order -> name}}'"
                        :email= "'{{$order -> email}}'"
                    ></comp-food>

                @endforeach --}}

            @endforeach

        </div>

    {{-- </div> --}}

@endsection