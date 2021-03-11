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
          {{-- <nav class="navbar-menu">
            @foreach ($user -> food as $food)
            <span><a href="#{{ $food -> category }}">{{ $food -> category }}</a></span>
            @endforeach
          </nav> --}}

          <!-- Sezione menu -->
            <div class="col-md-6">
              <div class="menu" data-spy="scroll" data-target=".navbar" data-offset="50">
  				      @foreach ($user -> food as $food)

                <!-- Categoria principale -->
                <div class="" id="{{ $food -> category }}">
                   <h3>{{ $food -> category }}</h3>
                </div>


                <!-- Card food -->
                <div class="card" style="width: 18rem;" data-toggle="modal" data-target="#myModal">
                  <img src="https://flawless.life/wp-content/uploads/2016/03/lievita-pizza-gourmet.jpg" class="card-img-top" alt="immagine piatto">
                  <div class="card-body">
                    <div class="food-item">
                      <h4>{{ $food->name }}</h4>
                      <span>{{ $food->description }}</span>
                      <div class="price">
                        <h6>{{ $food->price/100}} euro</h6>
                      </div>
                    </div>
                  </div>
                </div>


                  {{-- Pop-up food --}}
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{$food->name}}</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <img src="https://flawless.life/wp-content/uploads/2016/03/lievita-pizza-gourmet.jpg" class="card-img-top" alt="immagine piatto">
                      <div class="food-item">
                        <h4>{{ $food->name }}</h4>
                        <span>{{ $food->description }}</span>
                        <div class="price">
                          <h6>{{ $food->price/100 }} euro</h6>
                        </div>
                        <button type="button" name="button">Aggiungi al carrello</button>
                      </div>
                      {{-- <food
                          :price= "'{{$food -> price}}'"
                          :description= "'{{$food -> description}}'"
                      ></food> --}}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    </div>
                  </div>
                </div>
              </div>
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
          {{-- <food-cart
              :foods="{{$user -> food}}"
              :user_id="'{{$user -> id}}'"
          ></food-cart> --}}
        </div>
    </div> <!-- fine row -->
</div> <!-- fine container -->
@endsection
