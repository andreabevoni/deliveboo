@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

          <h1>{{ $user -> restaurant_name }}</h1>
          <p>{{ $user -> address }}</p>

          <div class="grey">
            <div class="food-item">
  				      @foreach ($user -> food as $food)
  					    <h3>
                  {{ $food -> category }}
                    <ul>
        					    <li>
                        <h4>{{ $food -> name }}</h4>
        					   </li>
                   </ul>
  					   </h3>
  				     @endforeach
            </div>



          </div>

          <button>
            <a href="{{ route('index') }}">Torna in Home
            </a>
          </button>

        </div>
        <div class="col-md-4">

          <img src="https://www.laghettofonteviva.it/wp-content/uploads/2016/05/pizza-400x250px.jpg" alt="">
        </div>
    </div>
</div>
@endsection
