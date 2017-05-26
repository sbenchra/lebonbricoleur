@extends('layouts.landing')

@section('title')
Inscription
@endsection

@section('header')

<div class="col-sm-7">
    <div class="header-content">
        <div class="header-content-inner" style="color: white">
            <h2>
                Des centaines de bricoleurs et de clients utilisent notre plateforme.
            </h2>
            <h3>Créer un compte gratuit maintenant pour les rejoindre. Cela va vous prendre moins de 2 minutes :)</h3>
        </div>
    </div>
</div>
@endsection

@section('sections')
<section class="container">
    <div class="row">
        <div class="col-md-7">
            <form action="" method="POST" role="form" action="{{ route('register') }}">

                <legend>Créer un compte</legend>
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nom complet</label>


                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif

                </div>
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Adresse email</label>


                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>
                <label>Type de compte:</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="role" id="role" value="1" checked>
                    Bricoleur
                </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="role" id="role" value="2">
                Client
            </label>
        </div>

        <div class="form-group">
            <label for="ville">Ville</label>
            <select class="form-control" name="ville">
                <option value="Paris">Paris</option>
                <option value="Toulouse">Toulouse</option>
                <option value="Marseille">Marseille</option>
                <option value="Montpellier">Montpellier</option>
            </select>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Mot de passe</label>


            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif

        </div>

        <div class="form-group">
            <label for="password-confirm">Retappez le mot de passe</label>


            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

        </div>

        <button type="submit" class="btn btn-primary">Créer un compte gratuit</button>
    </form>
</div>

</section>

@endsection


