@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <h2 class="mx-5 mt-5 mb-3">{{ __('Ripristina Piatto') }}</h2>
                <div class="cartella mb-5 p-5">

                    <form method="POST" action="{{ route('restore-task') }}">
                        @csrf
                        @method('POST')

                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="col-sm-10">
                                <label for="name"
                                    class="p-3">{{ __('Nome Piatto') }}</label>

                                <select name="name" id="">
                                    @foreach ($deletedFood as $food)
                                        <option value="{{ $food->id }}">{{ $food->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="">
                                <button type="submit" class="bottone-generale">
                                    {{ __('Ripristina') }}
                                </button>
                            </div>
                        
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
