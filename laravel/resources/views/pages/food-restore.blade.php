@extends('layouts.app')
@section('content')
    {{-- @php
    dd($foods);
    @endphp --}}


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ripristina Piatto') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('restore-task') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Piatto') }}</label>

                                <div class="col-md-6">
                                    <select name="name" id="">
                                        @foreach ($deletedFood as $food)
                                            <option value="{{ $food->id }}">{{ $food->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ripristina') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
