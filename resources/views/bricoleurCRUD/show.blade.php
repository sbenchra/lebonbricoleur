@extends('layouts.dashboard')

@section('css')

<link rel="stylesheet" type="text/css" href="/css/rating.css">

@endsection

@section('title')

{{ $bricoleur->name }} reviews

@endsection

@section('page-header')

{{$bricoleur->name }}

@endsection
@section('button-href') #new_project_modal @endsection
@section('button-caption') Créer un nouveau projet @endsection
@section('side-bar-links')

@include('layouts.client_nav')
@endsection

@section('dashboard-content')
<div class="reviews">
@if(count($bricoleur->getReviews()) != 0)
	<ul class="list-group">

			@foreach($bricoleur->getReviews() as $review)
			<li class="list-group-item">
				
			<strong>{{ $review->getOwnerName()[0]->name }} </strong><br>
			{{$review->created_at->diffForHumans()}} <br>
			{{ $review->body }}	<br>
						 	
			@for( $i =0 ; $i< 5 ;$i++)
				@if($i < $review->score ) 
				<span class="glyphicon .glyphicon-star glyphicon-star"></span>
				@else
				<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>
				@endif
			@endfor


		</li>
		<hr>
		@endforeach
	</ul>
@else
	<p>Aucune évaluation existe pour le moment !</p>
@endif
<form id="myForm" action="/review" method="POST" role="form">

	{{ csrf_field() }}

	<div class="form-group">
		<section>

			<label for="">Nouveau commentaire :</label>
			<input type="text" class="form-control" name="body" id="" placeholder="Input field">

				
					<label for="">Score :</label>
					<div class="container">
						<div class="row lead evaluation">
							<div id="colorstar" class="starrr ratable" ></div>
							<span id="count">0</span> star(s) - <span id="meaning"> </span>
						</div>
					</div>
			
			<input type="hidden" class="form-control" value="" id="score" name="score">
			<input type="hidden" class="form-control" name="bricoleur_id" value="{{ $bricoleur->id }}" >

		</section>
	</div>

	<button type="submit" class="btn btn-primary">Ajouter l'évaluation</button>
</form>
</div>
@endsection

@section('js')

<script src="/js/rating.js"></script>



@endsection