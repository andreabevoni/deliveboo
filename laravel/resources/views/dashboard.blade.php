@extends('layouts.app')

@section('dashboard')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <h1>
                        Benvenuto {{ Auth::user()->restaurant_name }}
                    </h1>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">


                                @if (Auth::user()->image)
                                    <img class="img-fluid" src="{{ asset('storage/icon/' . Auth::user()->image) }}" alt=""
                                        height="200px" width="200px">
                                @else
                                    <img class="img-fluid" src="{{ asset('storage/img/noimg.png') }}" alt=""
                                        height="200px" width="200px">
                                @endif



                                <div class="card-body">
                                    <h5 class="card-title">Tipologie</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>
                                <ul class="list-group list-group-flush">

                                    @foreach (Auth::user()->typologies as $typ)
                                        <li class="list-group-item">{{ $typ->name }}</li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Le tue informazioni</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Nome: {{ Auth::user()->restaurant_name }}</li>
                                    <li class="list-group-item">Email: {{ Auth::user()->email }}</li>
                                    <li class="list-group-item">Indirizzo:{{ Auth::user()->address }}</li>
                                    <li class="list-group-item">Telefono: {{ Auth::user()->phone }}</li>
                                    <li class="list-group-item">Giorno di chiusura:{{ Auth::user()->closing_day }}</li>
                                    <li class="list-group-item">Apertura da:{{ Auth::user()->opening_time }}</li>
                                    <li class="list-group-item">Chiusura alle:{{ Auth::user()->closing_time }}</li>
                                </ul>




                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label for="icon">Upload your Image</label>
                                <input type="file" name="icon" id="" class="form-control border-0 mb-2" placeholder=""
                                    aria-describedby="helpId">
                                <input type="submit" class="btn btn-success" value="Upload">
                                <a href="{{ route('clear-avatar') }}" class="btn btn-danger">Delete</a>
                                <small id="helpId" class="text-muted">Upload your image here</small>
                            </div>
                        </form>



                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.
                                </p>
                                <a href="{{ route('food.index') }}" class="btn btn-primary">Lista piatti</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.
                                </p>
                                <a href="{{ route('orders.index') }}" class="btn btn-primary">Ordini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>







    </div>
@endsection
