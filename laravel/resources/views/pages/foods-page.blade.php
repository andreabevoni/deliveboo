@extends('layouts.app')
@section('content')

    {{-- <div class="row"> --}}
    <div class="container-fluid">

        @if (Auth::user()->food->isEmpty())

            <div class="row py-5">
                <div class="cartella col-md-4 mx-auto">

                    <img src="{{asset('/img/piatto-vuoto.jpg')}}" width="100%" alt="">

                    <div class="p-3">

                        <h4>
                            Opss Nessun piatto!! Prova creando o ripristinando un piatto
                        </h4>
                        <div class="mx-auto link pt-4 text-center">

                            <a class="bottone-generale" href="{{ route('food.create') }}">
                                Crea piatto
                            </a>

                            <a href="{{ route('food-restore') }}" class="bottone-generale">
                                Ripristina
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            @else

            <div class="row piatti">

                <div class="col-sm-12 d-flex justify-content-around pt-5">
                    <h2>Elenco del cibo</h2>

                    <div>

                        <a class="" href="{{ route('food.create') }}">

                            Aggiungi
                        </a>

                        <a href="{{ route('food-restore') }}" class="">
                            Restore
                        </a>
                    </div>

                </div>

            </div>

            <div class="row mx-3 pb-5">

                {{-- <div class="col-sm-12"> --}}

                    @foreach ($foods as $food)
                        <div class="col-sm-12 col-lg-6">

                            <comp-food :namefood='"{{ $food->name }}"' :price="{{ $food->price }}"
                                :description="'{{ $food->description }}'" :id="{{ $food->id }}"
                                :available="{{ $food->visible }}" :image="'{{ $food->image }}'">
                            </comp-food>

                        </div>
                    @endforeach

                {{-- </div> --}}

            </div>

        @endif

    </div>


@endsection
