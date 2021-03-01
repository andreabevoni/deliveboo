@extends('layouts.app')

@section('content')

	<h1>Risultati</h1>

	<ul>
		@foreach ($users as $user)
			<li>
				<a href="{{ route('user-show', $user -> id) }}">
					{{ $user -> restaurant_name }}
				</a>
			</li>
		@endforeach
	</ul>

@endsection
