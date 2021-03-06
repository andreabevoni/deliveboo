@extends('layouts.app')
@section('content')

    <div class="container">
        {{-- @php
            dd($food->image, $food->name, $food->id);
        @endphp --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifica piatto') }}</div>

                    <div class="card-body">
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
                                <label for="price"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Prezzo') }}</label>

                                <div class="col-md-6">
                                    <input required min="1" id="price" type="number" value="{{ $food->price }}"
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
                                    <input required id="description" minlength="5" type="text"
                                        value="{{ $food->description }}"
                                        class="form-control @error('description') is-invalid @enderror" name="description"
                                        value="{{ old('description') }}" required autocomplete="description" autofocus>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" value="{{ $food->image }}" class="form-control"
                                        name="image">

                                    <a href="{{ route('clear-food-img', $food->id) }}" class="btn btn-danger">Clear</a>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="category"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                                <div class="col-md-6 input-group mb-3">

                                    <select required name="category" class="custom-select" id="inputGroupSelect01">
                                        @foreach ($foods as $food)
                                            <option value="{{ $food->category }}">
                                                {{ $food->category }}
                                            </option>

                                        @endforeach

                                    </select>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="visible"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Disponibile') }}
                                </label>


                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="visible" id="inlineRadio1" value='1'
                                        @if ($food->visible == 1) checked @endif>
                                    <label class="form-check-label" for="visible">Sì</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="visible" id="inlineRadio2" value="0"
                                        @if ($food->visible == 0) checked @endif>
                                    <label class="form-check-label" for="visible">No</label>
                                </div>
                                @if ($errors->any())

                                    <ul class="row justify-content-center">{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
                                @endif

                            </div>


                            <div class="col-md-6">

                                <input class="btn btn-success" type="submit" value="Salva">

                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Immagine</div>
                            <div class="card-content">

                                <img src="#" id="preview" width="200px" height="200px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#preview").attr("src", e.target.result);
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
