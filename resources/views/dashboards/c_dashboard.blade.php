@extends('layouts.dashboard')

@section('title')

Le bon bricoleur

@endsection

@section('page-header')

Dashboard

@endsection

@section('css')
<!--
<link rel="stylesheet" type="text/css" href="/css/multi-select.css">
-->
<link rel="stylesheet" type="text/css" href="/css/tags.css">
<style type="text/css">
	.t {
		font-size: 25pt;
		color: white;
	}

	.lava {
		background-color: #f8591a;
	}

	.sky {
		background-color: #0D8FDB;
	}

	.vine {
		
	}
</style>
@endsection

@section('side-bar-links')

@include('layouts.client_nav');

@endsection

@section('button-href') #new_project_modal @endsection
@section('button-caption') Créer un nouveau projet @endsection
@section('dashboard-content')
<div class="row placeholders">
	<div class="col-xs-6 col-sm-3 placeholder">
		<div class="t lava" v-text="stats.count">
			
		</div>
		<h4>Nombre total d'annonces</h4>
	</div>
	<div class="col-xs-6 col-sm-3 placeholder">
		<div class="t sky" v-text="stats.encours">
			
		</div>
		<h4>Nombre d'annonces en cours</h4>
	</div>
	<div class="col-xs-6 col-sm-3 placeholder">
		<div class="t lava" v-text="stats.acheves">
			
		</div>
		<h4>Nombre de travaux achevés</h4>
	</div>
	<div class="col-xs-6 col-sm-3 placeholder">
		<div class="t" v-text="stats.acheves">
			
		</div>
		<h4># d'intéréssés par la dernière demande</h4>
	</div>
</div>


<div  style="color: black;" class="modal fade" id="new_project_modal">
	<div id="app" class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Créer un nouveau projet</h4>
			</div>
			<div  class="modal-body">


				<div v-if="success" class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Annonce ajoutée avec success
				</div>
				<div class="form-group">
					<label for="titre">Titre</label>
					<input type="text" v-model="titre" class="form-control" id="titre" placeholder="Titre">
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" v-model="description" id="description">Description</textarea>
				</div>

				<div class="form-group">
					<label for="adresse">Adresse</label>
					<textarea class="form-control" v-model="adresse" id="adresse">Adresse</textarea>
				</div>

				<div class="form-group">
					<label for="budget_initial">Budget initial</label>
					<input class="form-control" placeholder="Budget initial" type="number" v-model="budgetInitial" id="budget_initial">
				</div>
				<div class="form-group">
					<label for="date_limite">Date limite</label>
					<input class="form-control" id="date_limite" type="date" v-model="dateLimite" placeholder="aaaa-mm-jj">
				</div>
				<div class="form-group">
					<label for="pre-selected-options">Métiers</label>
					<!-- to switch back to old stuff add multiple='multiple' -->
					<select class="form-control" id='pre-selected-options'>
						@foreach($metiers as $metier)
						<option value="{{ $metier->name }}">{{ $metier->name }}</option>
						@endforeach
					</select>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" @click ="houseKeeping()" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" @click="addAnnonce()" class="btn btn-primary">Publier</button>
			</div>
		</div>
	</div>
</div>
<h2 class="sub-header">Mes denières annonces</h2>
<div class="row">
	<div v-for="annonce in annonces" class="col-md-6 panel panel-primary" style="border: none; ">
                <div class="panel-heading" style="border: 1px solid gray">@{{ annonce.titre }}</div>
                <div class="panel-body" style="border: 1px solid gray">
                    @{{ annonce.description }}
                <br>
                <br>
                <ul class="list-unstyled">
                    <li class=" lead list-group-item-text">Budget initial : @{{ annonce.budget_initial }}</li>
                    <li class="lead list-group-item-text">Date limite: @{{ annonce.date_limite }}</li>
                </ul>
                 <ul class="tags">
                      <li v-for="metier in annonce.metiers" class="tag"><a href="#" v-text="metier.name"></a></li>
                  </ul>
              </div>
              <div class="panel-footer" style="border: 1px solid gray">
               Publiée il y a @{{ timeSince(annonce.created_at) }}
               <span class="pull-right">
                   <a :href="'/annonces/' +  annonce.id ">+ de détails</a>
               </span>
            </div>
        </div>
</div>
@endsection

@section('js')
<script src="/js/app.js"></script>
<script src="/js/holder.js"></script>
@endsection
