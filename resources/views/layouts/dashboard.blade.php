<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Le bon bricoleur - @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Core CSS -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

   @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

   @include('layouts.nav')

<div @if (Auth::user()->role === 2) id="app" @endif class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            @yield('side-bar-links')
          </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @if(Auth::user()->role === 1) 
        <div id = "app">
        @endif
          <h1 class="page-header">@yield('page-header') <a @yield('custom-vue') class="pull-right btn btn-primary btn-xl" data-toggle="modal" href='@yield("button-href")'>@yield('button-caption')</a></h1>
        @if(Auth::user()->role === 1)
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
        @endif
          @yield('dashboard-content')
      
        </div> <!-- /content -->
      </div> <!-- /row -->


    </div> <!-- /container-fluid-->
    <!--@include('layouts.footer')-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
        <!-- jQuery -->
        <script src="/lib/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/lib/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
        <script src="/js/vue.js"></script>
		<script src="/js/axios.min.js"></script>
        @yield('js')
  </body>
</html>
