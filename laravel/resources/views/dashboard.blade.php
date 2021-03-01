@extends('layouts.app')

@section('dashboard')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
        </div>
    </div>
@endsection
