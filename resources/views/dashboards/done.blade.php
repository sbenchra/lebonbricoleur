@extends('layouts.dashboard')


@section('title')

Le bon bricoleur

@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="/css/multi-select.css">
@endsection

@section('page-header')
Travaux achevés
@endsection

@section('side-bar-links')

<li><a href="{{route('dashboard')}}">Vue d'ensemble</a></li>
<li><a data-toggle="collapse" data-target="#links" href="#">Mes offres</a></li>
<ul style="margin-left: 10px" class="nav collapse" id="links">
	<li><a href="{{ route('offres') }}">Toutes les offres</a></li>
	<li><a href="{{ route('pending') }}">Offres en attente de validation</a></li>
	<li><a href="{{ route('done') }}">Travaux achevés</a></li>
</ul>

@endsection

@section('custom-vue') @click="populateSelect()" @endsection
@section('button-href') #services_modal @endsection
@section('button-caption') Modifier vos services @endsection


@section('dashboard-content')
<div id = "app-2" >

	<div class="row">
		<div v-for="(annonce, i) in annonces_done" class=" col-md-6 panel panel-primary" style="border: none; ">
                <div class="panel-heading" style="border: 1px solid gray">@{{ annonce.titre }}</div>
                <div class="panel-body" style="border: 1px solid gray">
                    @{{ annonce.description }}

                    <ul class="list-unstyled">
                        <li class=" lead list-group-item-text">Budget initial : @{{ annonce.budget_initial }}</li>
                        <li class="lead list-group-item-text">Date limite: @{{ annonce.date_limite }}</li>
                    </ul>
                </div>
                <div class="panel-footer" style="border: 1px solid gray">
                 Publiée il y a @{{ timeSince(annonce.created_at) }} par @{{ users[annonce.user_id - 1] }}
                 <span class="pull-right">
                     <!--<a data-toggle="modal" href='#interested-modal' @click="prepareModal(annonce)">Je suis interéssé</a>-->
                 </span>
             </div>
         </div>

	</div>
	
</div>

@endsection


@section('js')
<script src="/js/jquery.multi-select.js"></script>
<script src="/js/waiting.js"></script>
<script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
</script>

<script src="/js/holder.js"></script>
@endsection
