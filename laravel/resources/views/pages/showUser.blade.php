@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

          <!-- Info ristorante -->
          <div class="info">
            <h1>{{ $user -> restaurant_name }} </h1>
            <span>{{ $user -> address }} ° </span>
            <span>Telefono: {{ $user -> phone }}  ° </span>
            <span>Email: {{ $user -> email }}   </span>
          </div>


          <!-- Barra scelta categoria -->
          <nav class="navbar-menu">
            @foreach ($user -> food as $food)
            <span><a href="#">{{ $food -> category }}</a></span>
            @endforeach
          </nav>

          <!-- Sezione menu -->
            <div class="col-md-4">
              <div class="menu">
  				      @foreach ($user -> food as $food)

                <!-- Categoria principale -->
  					    <h3>{{ $food -> category }} </h3>

                <!-- Card food -->
                  <food
                      :name= "'{{$food -> name}}'"
                      :price= "{{$food -> price}}"
                      :description= "'{{$food -> description}}'"
                  ></food>
  				     @endforeach
             </div>
            <!-- Button per tornare ai risultati di ricerca -->
            <button>
              <a href="{{ route('index') }}">Torna in Home</a>
            </button>
          </div> <!-- fine sezione menu -->

        </div> <!-- fine contenitore di sinistra -->

        <!-- Sezione di destra -->
        <div class="col-md-4">
          <!-- Img profilo -->
          <img src="https://www.laghettofonteviva.it/wp-content/uploads/2016/05/pizza-400x250px.jpg" alt="">

          <!-- Carrello -->
        </div>
    </div> <!-- fine row -->
</div> <!-- fine container -->
@endsection
