@extends('layouts.app')
@section('content')

            {{-- @php
                dd($food->visible);
            @endphp --}}

    <div class="row d-flex justify-content-around py-4">
        <h2>
            Edit Food
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 card p-5">

            <form action="{{ route('food.update', $food->id) }}" method="POST">

                @csrf
                @method('PUT')


                <label for="name">Nome</label>
                <input name="name" type="text" value="{{ $food->name }}">
                <br>
                <label for="price">Prezzo</label>
                <input name="price" type="text" value="{{ $food->price }}">
                <br>
                <label for="description">Descrizione</label>
                <input name="description" type="text" value="{{ $food->description }}">
                <br>
                <label for="visible">Visibilitá</label>
                <input name="visible" type="number" value="{{ $food->visible }}">
                <br>


                {{-- select --}}
                {{-- <label for="category">Categoria</label>
                <select name="category">
                    @foreach ($foods as $food)

                        <option value="{{ $food->id }}">
                            {{ $food->category }}
                        </option>
                    @endforeach
                </select> --}}

                <br>
                <label for="image">Immagine</label>
                {{-- <input name="image" type="file"> --}}
                <input name="image" type="file">
                <br>

                <br>
                <input class="btn btn-warning" type="submit" value="Salva">

            </form>

        </div>

    </div>
@endsection
