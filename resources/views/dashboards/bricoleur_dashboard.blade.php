@extends('layouts.landing')

@section('css')

<link rel="stylesheet" type="text/css" href="/css/multi-select.css">
@endsection

@section('header')
<input id="user" type="hidden" value="{{ $user_id }}">

<div id="app" >
    <div class="col-sm-7">
        <div class="header-content">
            <div class="header-content-inner" style="color: white">
                <h2>
                    Vous voulez élargir votre clientèle?
                </h2>
                <h3>
                    Ajouter les services que vous assurez, et laissez le reste sur nous.
                </h3>
                <a @click="populateSelect()" class="btn btn-outline btn-xl" data-toggle="modal" href='#services_modal'>Modifier vos services</a>
            </div>
        </div>
    </div>

    <div style="color: black;" class="modal fade" id="services_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modifier vos services</h4>
                </div>
                <div  class="modal-body">


                    <div v-if="success" class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Services modifiés avec succès
                    </div>
                    <div class="form-group">
                        <label for="pre-selected-options">Métiers</label>
                        <select id='pre-selected-options' multiple='multiple'>
                            @foreach($metiers as $metier)
                            <option value="{{ $metier->name }}">{{ $metier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button @click="houseKeeping()" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="button" @click="updateServices()" class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('sections')

<div id="app-2" class="container">
    <div class="page-header">
        <h1>Projets qui peuvent vous interessez</h1>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-8">
       
            <div v-for="(metier, index) in annonces">
            <h2 :id="index">@{{ index }} <span class="badge" v-text="metier.length"></span></h2>
            <div v-for="(annonce, i) in metier" class="panel panel-primary">
                <div class="panel-heading">@{{ annonce.titre }}</div>
                <div class="panel-body">
                    @{{ annonce.description }}
              </div>
              <ul class="list-unstyled">
                    <li class=" lead list-group-item-text">Budget initial : @{{ annonce.budget_initial }}</li>
                    <li class="lead list-group-item-text">Date limite: @{{ annonce.date_limite }}</li>
                </ul>
              <div class="panel-footer">
               Publiée il y a @{{ timeSince(annonce.created_at) }} par @{{ users[annonce.user_id - 1] }}
               <span class="pull-right">
                   <a data-toggle="modal" href='#interested-modal' @click="prepareModal(annonce)">Je suis interéssé</a>
               </span>
            </div>
        </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    Navigation rapide
                </div>
               <ul class="list-group">
                      
                    <a v-for="(metier, index) in annonces" :href="'#' + index" class="list-group-item" >@{{ index }} <span class="badge" v-text="metier.length"></span></a>
                </ul>
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
                <input type="hidden" id="annonce_id">
                <div class="form-group">
                    <input type="hidden" id="annonce_id">
                    <label for="budget_suggere">Budget suggéré </label>
                    <input id="budget_suggere" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for="date_limite">Date limité suggérée</label>
                    <input class="form-control" type="date" id="date_limite">
                </div>
            </div>
            <div class="modal-footer">
                <button id="annuler" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="test" @click="imIn()" type="button" class="btn btn-primary">Je suis intéressé</button>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

@section('js')
<script src="/js/jquery.multi-select.js"></script>
<script src="/js/vue.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/bricoleur.js"></script>
<script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
</script>
@endsection