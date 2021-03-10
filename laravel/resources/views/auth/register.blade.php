@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
        <div class="row">
            <div class="col-md-6">
                <div class="headline">
                  <h1>Diventa subito partner di Deliveboo</h1>
                    <div>
                     </div>
                    <div class="form-registration">
                      <p>Aumenta le tue vendite fino al 30% grazie alle consegne a domicilio</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group row">
                                <label for="restaurant_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Ristorante') }}</label>

                                <div class="col-md-6">
                                    <input required maxlength="100" id="restaurant_name" type="text"
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
                                    <input required minlength="5" maxlength="100" maxlength="100" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                    <input required minlength="8" maxlength="100" id="address" type="text"
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
                                    <input required id="p_iva" minlength="11" maxlength="11" type="text"
                                        class="form-control @error('p_iva') is-invalid @enderror" name="p_iva"
                                        value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus>

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
                                    <input required minlength="8" id="password" type="password"
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
                                    <input required minlength="8" id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>



                            {{-- Qui cicliamo tutte le tipologie con il foreach --}}

                            @foreach ($typologies as $typology)
                                <div class="form-check form-check-inline mb-4">

                                    <input name="typologies[]" class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                        value={{ $typology->id }}>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $typology->name }}</label>

                                </div>

                            @endforeach

                            @if ($errors->any())

                                <ul class="row justify-content-center">{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
                            @endif


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Carosello immagini --}}
            <div class="col-md-6 img-background">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('img/carousel-reg1.jpg')}}" class="d-block w-100" alt="...">
                  </div>
              <div class="carousel-item">
                <img src="{{ asset('img/carousel-reg2.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/carousel-reg3.jpg')}}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
        </div>
      </div>
    {{-- </div> --}}
@endsection
