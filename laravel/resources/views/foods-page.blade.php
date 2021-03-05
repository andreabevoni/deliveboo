@extends('layouts.app')
@section('content')

    {{-- <div class="row"> --}}
    <div class="row d-flex justify-content-around py-4">

        <h2>Foods</h2>
        <button class="btn btn-warning">
            <a href="{{ route('food.create') }}">

                Aggiungi
            </a>
        </button>

        <a href="{{ route('food-restore') }}" class="btn btn-primary">
            Restore
        </a>
    </div>
    <div>

        {{-- @if (!!$foods) --}}

        @foreach ($foods as $food)

            {{-- @php
                dd($food->id);
            @endphp --}}

            <comp-food :namefood="'{{ $food->name }}'" :price="{{ $food->price }}"
                :description="'{{ $food->description }}'" :id="{{ $food->id }}" :available="{{ $food->visible }}">
            </comp-food>
        @endforeach



        {{-- @else
            <div>No Food added Yet, please create one</div>
        @endif --}}
    </div>

    {{-- </div> --}}

@endsection
