@extends('layouts.dashboard')

@section('title')

Le bon bricoleur

@endsection

@section('page-header')

Demandes archivées

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

@include('layouts.client_nav')

@endsection
@section('button-href') #new_project_modal @endsection
@section('button-caption') Créer un nouveau projet @endsection
@section('dashboard-content')



<div class="row">
	<div v-for="annonce in annonces_done" class="col-md-6 panel panel-primary" style="border: none; ">
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
<script src="/js/encours.js"></script>
<script src="/js/holder.js"></script>
@endsection
