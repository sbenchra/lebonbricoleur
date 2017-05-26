@extends('layouts.dashboard')

@section('title')

Le bon bricoleur

@endsection

@section('page-header')
Dashboard | Dernières offres de travail
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="/css/multi-select.css">
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
    <div v-for="(metier, index) in annonces">
        <h2 :id="index">@{{ index }} <span class="badge" v-text="metier.length"></span></h2>
        <div class="row">
            <div v-for="(annonce, i) in metier.slice(0,2)" class=" col-md-6 panel panel-primary" style="border: none; ">
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
                     <a data-toggle="modal" href='#interested-modal' @click="prepareModal(annonce)">Je suis interéssé</a>
                 </span>
             </div>
         </div>
     </div>
 </div>
</div>
<div class="modal" id="interested-modal">
    <div id="app-3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div v-if="success" class="alert alert-success">Action effectuée aves succès</div>
                <input type="hidden" id="annonce_id">
                <div class="form-group">
                    <input type="hidden" id="annonce_id">
                    <label for="budget_suggere">Budget suggéré </label>
                    <input id="budget_suggere" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for="date_limite">Date limite suggérée</label>
                    <input class="form-control" type="date" id="date_limite">
                </div>
            </div>
            <div class="modal-footer">
                <button @click="houseKeeping()" id="annuler" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="test" @click="imIn()" type="button" class="btn btn-primary">Je suis intéressé</button>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('js')
<script src="/js/jquery.multi-select.js"></script>
<script src="/js/bricoleur.js"></script>
<script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
</script>

<script src="/js/holder.js"></script>
@endsection
