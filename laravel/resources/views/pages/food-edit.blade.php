@extends('layouts.app')
@section('content')

    <div class="container">
        {{-- @php
            dd($food->image, $food->name, $food->id);
        @endphp --}}
        <div class="row">

            <div class="col-md-10 text-center">
                <h2 class="mt-5 mb-4">{{ __('Modifica piatto') }}</h2>
            </div>

            <div class="col-sm-12 col-md-12 mb-4 d-lg-flex">

                <div class="col-sm-12 col-lg-8">

                    <form method="POST" action="{{ route('food.update', $food->id) }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nome Piatto') }}</label>

                            <div class="col-md-6">
                                <input required minlength="3" maxlength="50" id="name" type="text"
                                    value="{{ $food->name }}" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Prezzo') }}</label>

                            <div class="col-md-6">
                                <input required min="1" id="price" type="number" step="0.01"
                                    value="{{ $food->price / 100 }}"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-right">{{ __('Descrizione') }}</label>

                            <div class="col-md-6">
                                <textarea required id="description" minlength="5" type="text"
                                    value="{{ $food->description }}"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') }}" required autocomplete="description" autofocus>{{ $food->description }}
                                            </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- <div class="form-group row">
                            <label for="category"
                                class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                            <div class="col-md-6 input-group">

                                <select required name="category" class="custom-select" id="inputGroupSelect01">
                                    @foreach ($foods as $food)
                                        <option value="{{ $food->category }}">
                                            {{ $food->category }}
                                        </option>

                                    @endforeach

                                </select>
                            </div>

                        </div> --}}


                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>

                            <div class="col-md-6 d-flex">
                                <input id="image" type="file" value="{{ $food->image }}" class="form-control"
                                    name="image">

                                <a href="{{ route('clear-food-img', $food->id) }}" class="btn bottone-edit-elimina">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="visible" class="col-md-4 col-form-label text-md-right">{{ __('Disponibile') }}
                            </label>

                            <div class="form-check form-check-inline mx-3">
                                <input class="form-check-input" type="radio" name="visible" id="inlineRadio1" value='1' @if ($food->visible == 1) checked @endif>
                                <label class="form-check-label" for="visible">Sì</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visible" id="inlineRadio2" value="0" @if ($food->visible == 0) checked @endif>
                                <label class="form-check-label" for="visible">No</label>
                            </div>
                            @if ($errors->any())

                                <ul class="row justify-content-center">{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
                            @endif

                        </div>


                        <div class="col-sm-12 text-center mb-5">

                            <input class="px-5 bottone-generale" type="submit" value="Salva">

                        </div>

                    </form>

                </div>

                <div class="col-sm-12 col-lg-4 text-center">
                    {{-- <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Preview Immagine</div>
                            <div class="card-content text-center"> --}}

                    <img class="img-thumbnail rounded mx-auto" src="#" id="preview" width="300px" height="200px">
                    {{-- </div>
                        </div>
                    </div> --}}
                </div>

            </div>

        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function() {


            hideImg();

            function hideImg() {
                var img = $('#preview');
                img.attr('src') === '#' ? img.hide() : img.show();
            }


            function readURL(input) {
                $('#preview').hide();
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#preview").attr("src", e.target.result);
                        // console.log($('#preview').attr('style'));
                        $("#preview").show();
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function() {
                readURL(this);
            });
        });

    </script>
@endsection
