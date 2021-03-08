@extends('layouts.app')
@section('content')

    {{-- <div class="row"> --}}
    <div class="container-fluid">

        @if (Auth::user()->food->isEmpty())


            <div class="row">
                <div class="col-md-12 mx-auto">

                    <h1>
                        Opss Nessun piatto!! Prova creando o ripristinando un piatto
                    </h1>
                    <div class="mx-auto link">


                        <a class="btn btn-success" href="{{ route('food.create') }}">
                            Crea piatto
                        </a>

                        <a href="{{ route('food-restore') }}" class="btn btn-primary">
                            Restore
                        </a>

                    </div>
                </div>





            @else
                <div class="col-sm-12">
                    <h2>Foods</h2>
                    <a class="btn btn-warning" href="{{ route('food.create') }}">

                        Aggiungi
                    </a>

                    <a href="{{ route('food-restore') }}" class="btn btn-primary">
                        Restore
                    </a>

                </div>
                <div class="row row-cols-2">



                    @foreach ($foods as $food)
                        <div class="col">


                            <comp-food :namefood="'{{ $food->name }}'" :price="{{ $food->price }}"
                                :description="'{{ $food->description }}'" :id="{{ $food->id }}"
                                :available="{{ $food->visible }}" :image="'{{ $food->image }}'">
                            </comp-food>
                        </div>

                    @endforeach
                </div>

            </div>
        @endif
    </div>


@endsection
