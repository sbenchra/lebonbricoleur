@extends('layouts.dashboard')

@section('title')
Le bon bricoleur
@endsection

@section('css')
<!--
<link rel="stylesheet" type="text/css" href="/css/multi-select.css">
-->
<link rel="stylesheet" type="text/css" href="/css/tags.css">

@endsection


@section('dashboard-content')

<div class="col-sm-7">
    <div class="header-content">
        <div class="header-content-inner" style="color: white">
            <h2>
                Besoin de travail effectué?
            </h2>
            <h3>
                Postez votre projet et recevez des offres concurrentielles auprès des bricoleurs en quelques minutes. Notre système de réputation facilitera la recherche d'un bricoleur parfait pour votre travail. C'est le moyen le plus simple et le plus sûr de faire des travaux en ligne.
            </h3>
            <a class="btn btn-outline btn-xl" data-toggle="modal" href='#new_project_modal'>Créer un nouveau projet</a>
        </div>
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
@endsection

@section('sections')

<div id="app-2" class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Mes annonces <span class="badge" v-text="annonces.length"></span></h2>
            <div class="text-center" v-if="loading">
                <i style="font-size: 20px" class="fa fa-spinner fa-spin"></i>
            </div>
            <div v-for="annonce in annonces" class="panel panel-primary">
                <div class="panel-heading">@{{ annonce.titre }}</div>
                <div class="panel-body">
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
              <div class="panel-footer">
               Publiée il y a @{{ timeSince(annonce.created_at) }}
               <span class="pull-right">
                   <a :href="'/annonces/' +  annonce.id ">+ de détails</a>
               </span>
            </div>
        </div>
    </div>
</div>

</div>

@endsection


@section('js')
<!--<script src="/js/jquery.multi-select.js"></script>-->
<script src="/js/vue.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/app.js"></script>
<!--
<script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
</script>
-->
<!-- cdn for modernizr, if you haven't included it already -->
<!--
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
-->
<!-- polyfiller file to detect and load polyfills -->
<!--
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>-->
@endsection
