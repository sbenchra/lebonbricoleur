@extends('layouts.master')

@section('content')

<header class="bg-pattern">
	<div class="container">
		<div class="row">
			
			@yield('header')

		</div>
	</div>
</header>

@yield('sections')

@endsection