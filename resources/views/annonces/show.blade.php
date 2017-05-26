@extends('layouts.dashboard')

@section('title')

{{ $annonce->titre }}

@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="/css/rating.css">

@endsection

@section('page-header')

{{ $annonce->titre }}

@endsection
@section('button-href') #new_project_modal @endsection
@section('button-caption') Créer un nouveau projet @endsection
@section('side-bar-links')

@include('layouts.client_nav')
@endsection

@section('dashboard-content')
@if($isValid)
<h3 class="sub-header">Les informations du bricoleur qui a effectué le travail</h3>
@else
<h3 class="sub-header">Les bricoleurs intéressés par cette annonce</h3>
@endif
@if(Session::has('message'))
<div  class="alert alert-success">Le bricoleur a été correctement validé</div>
@endif
<input id="id" type="hidden" name="annonce_id" value="{{ $annonce->id }}">
<form action="/annonces/{{ $annonce->id }}/validation" method="post" role="form">
	{{ csrf_field() }}
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nom complet</th>
				<th>Budget suggéré</th>
				<th>Date limite suggérée</th>
				<th>Score moyen</th>
				@if($isValid)
				<th>Noter</th>
				@else
				<th>Valider</th>
				@endif
				
			</tr>
		</thead>
		<tbody>
			<tr v-for="bricoleur in bricoleurs">
				<td v-text="bricoleur.name"></td>
				<td v-text="bricoleur.pivot.budget"></td>
				<td v-text="bricoleur.pivot.date_limite"></td>
				<td v-text="parseInt(rating) + ' / 5'"></td>
				@if($isValid)
				<td><a :href="'/bricoleurs/' + bricoleur.id" class="btn btn-primary">Noter</a></td>
				@else
				<td> <input type="radio" name="bricoleur_id" id="input" :value="bricoleur.id"> </td>
				@endif

			</tr>
		</tbody>
	</table>
	@if(!$isValid)
	<button type="submit" class="pull-right btn btn-primary">Valider</button>
	@endif

</form>
@endsection

@section('js')

@if($isValid)
	<script src="/js/rating.js"></script>
	<script src="/js/interested_2.js"></script>
@else
	<script src="/js/interested.js"></script>
@endif



@endsection