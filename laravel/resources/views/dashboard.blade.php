@extends('layouts.app')

@section('dashboard')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    Welcome user: <h1>
                        {{ Auth::user()->restaurant_name }}
                    </h1>

                    <h2>Your typologies are</h2>
                    <ul>
                        @foreach (Auth::user()->typologies as $typ)
                            <li>{{ $typ->name }}</li>

                        @endforeach
                    </ul>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>
            <div class="col-sm">

                {{-- form upload img --}}

                <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="icon">Upload your Image</label>
                        <input type="file" name="icon" id="" class="form-control border-0 mb-2" placeholder=""
                            aria-describedby="helpId">
                        <input type="submit" class="btn btn-success" value="Upload">
                        <a href="{{ route('delete-avatar') }}" class="btn btn-danger">Delete</a>
                        <small id="helpId" class="text-muted">Upload your image here</small>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm mx-auto">
                        <img src="{{ asset('storage/icon/' . Auth::user()->image) }}" alt="..." class="img-thumbnail">
                    </div>
                </div>
            </div>

            {{-- modifiche dashboard utente --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Modifica Dati Ristorante') }}</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            @method('POST')
                            <div class="form-group row">
                                <label for="restaurant_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="restaurant_name" type="text"
                                        class="form-control @error('restaurant_name') is-invalid @enderror"
                                        name="restaurant_name" value="{{ old('restaurant_name') }}" required
                                        autocomplete="restaurant_name" autofocus>

                                    @error('restaurant_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="p_iva"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Numero Partita IVA') }}</label>

                                <div class="col-md-6">
                                    <input id="p_iva" type="text" class="form-control @error('p_iva') is-invalid @enderror"
                                        name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus>

                                    @error('p_iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>



                            {{-- Qui cicliamo tutte le tipologie con il foreach --}}

                            {{-- @foreach ($typologies as $typology) --}}
                            <div class="form-check form-check-inline mb-4">

                                <input name="typologies[]" class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                    value=''>
                                <label class="form-check-label" for="inlineCheckbox1"></label>
                            </div>

                            {{-- @endforeach --}}


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
