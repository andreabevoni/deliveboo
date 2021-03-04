@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">

        <div class="card">

            <h2>
                Aggiunta Food
            </h2>
        </div>
        <div class="col-md-10 card p-5">


            <form action="{{ route('food.store') }}" method="post">

                @csrf
                @method('post')

                <label for="name">Nome</label>
                <input name="name" type="text">
                <br>
                <label for="price">Prezzo</label>
                <input name="price" type="text">
                <br>
                <label for="description">Descrizione</label>
                <input name="description" type="text">
                <br>

                {{-- select --}}
                <label for="category">Categoria</label>
                <select name="category">
                    @foreach ($foods as $food)

                        <option value="{{ $food->id }}">
                            {{ $food->category }}
                        </option>
                    @endforeach
                </select>

                <br>
                <label for="image">Immagine</label>
                {{-- <input name="image" type="file"> --}}
                <input name="visible" type="text">
                <br>
                <label for="visible">Visibilitá</label>
                <input name="visible" type="text">
                <br>
                <input class="btn btn-warning" type="submit" value="Salva">

            </form>

        </div>

    </div>

@endsection
