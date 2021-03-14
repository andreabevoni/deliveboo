@extends('layouts.app')

@section('dashboard')
    <div class="container-fluid">

        <div class="row titolo-dashboard">

            <div class="pt-5 pl-5">

                <h1>
                    Benvenuto {{ Auth::user()->restaurant_name }}
                </h1>
                <h4>
                    {{ Auth::user()->email }}
                </h4>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center dashboard">
            <div class="col-sm-12 my-5">

                <div class="row">

                    {{-- colonna di sinistra img user --}}
                    <div class="col-sm-12 col-md-6 mb-5">

                        <h2 class="px-3 card-title">La tua Immagine</h2>
                        <div class="card p-4">
                            <div class="card-img">

                                @if (Auth::user()->image)
                                    <img class="img-fluid" src="{{ asset('storage/icon/' . Auth::user()->image) }}" alt=""
                                        height="400px" width="400px">
                                @else
                                    <img class="img-fluid" src="{{ asset('/img/noimg.png') }}" alt=""
                                        height="400px" width="400px">
                                @endif
                            </div>

                            <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <br>

                                    <label for="icon"></label>
                                    <input type="file" name="icon" id="icon" class="mb-3 ml-1" placeholder=""
                                        aria-describedby="helpId">

                                    <br>
                                    <input type="submit" class="button" value="Carica">

                                    <a href="{{ route('clear-avatar') }}" class="button">Elimina</a>
                                    <small id="helpId" class="text-muted"></small>
                                </div>
                            </form>

                        </div>
                    </div>

                    {{-- colonna di destra con info user --}}
                    <div class="col-sm-12 col-md-6 mb-5">
                        {{-- <div class=""> --}}

                            <h2 class="px-3 card-title">Le tue Informazioni</h2>


                            <ul class="list-group list-group-flush">
                                <li class="my-2 card list-group-item">
                                    <strong>Nome: </strong> {{ Auth::user()->restaurant_name }}
                                </li>
                                <li class="my-2 card list-group-item">
                                    <strong>Indirizzo: </strong> {{ Auth::user()->address }}
                                </li>
                                <li class="my-2 card list-group-item">
                                    <strong>Telefono: </strong> {{ Auth::user()->phone }}
                                </li>
                                <li class="my-2 card list-group-item">
                                    <strong>Partita IVA: </strong> {{ Auth::user()->p_iva }}
                                </li>
                                {{-- <ul class="my-2 card list-group list-group-flush"> --}}
                                <li class="my-2 card list-group-item">
                                    <strong>Tipologie: </strong>
                                    @foreach (Auth::user()->typologies as $typ)
                                        {{ $typ->name }}

                                    @endforeach
                                </li>

                            </ul>

                        {{-- </div> --}}
                    </div>
                </div>

                <div class="row mb-4">

                    <div class="col-sm-6">
                        <a href="{{ route('food.index') }}">

                            <div class="mb-4 card lista piatti">
                                <h2>I tuoi piatti</h2>
                            </div>

                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('orders.index') }}">

                            <div class="mb-4 card lista ordini">
                                <h2>Ordini ricevuti</h2>
                            </div>

                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
