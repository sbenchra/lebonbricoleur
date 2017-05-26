@extends('layouts.landing')

@section('title')
Le bon bricoleur
@endsection

@section('header')


			<div class="col-sm-5">
				<div class="text-center">
					<div class="header-content">
						<div class="header-content-inner">
							<div class="img img-responsive">
								<img src="img/bricolage.png" width="300px" height="300px">
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-7">
				<div class="header-content">
					<div class="header-content-inner">
						<h2>Le bon bricoleur est une plateforme d'annonces gratuites, qui permet aux clients d'une part de déposer leurs demandes en terme de bricolage, et aux fournisseurs d'une autre part de répondre à ces besoins.</h2>
						<a href="#download" class="btn btn-outline btn-xl page-scroll">En savoir plus</a>
					</div>
				</div>
			</div>

@endsection

@section('sections')

<section id="features" class="features">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="section-heading">
					<h2>Pourquoi utiliser notre plateforme ?</h2>
					<hr>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-money" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Gratuite</h3>
					<p class="text-muted">Déposer votre annonce/offre à 0 Euro TTC.</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-envelope" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Messagerie intégrée</h3>
					<p class="text-muted">Bénéficier d'un service de messagerie intégré pour communiquer avec votre client/fournisseur.</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-bolt" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Rapide</h3>
					<p class="text-muted">S'inscrire, s'authentifier, et se régaler.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-shield" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Sécurisée</h3>
					<p class="text-muted"></p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-users" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Diversifiée</h3>
					<p class="text-muted">Notre plateforme présente plusieurs fonctionnalités que ça soit pour les clients ou les fournisseurs.</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="text-center">
					<i class="fa fa-exclamation-triangle" style="font-size: 9em" aria-hidden="true"></i>
					<h3>Zéro spam</h3>
					<p class="text-muted">Toutes les publications sur la plateforme sont vérifiées régulierement par nos modérateurs.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="cta bg-c">
	<div class="cta-content">
		<div class="container">
			<h2>Vous avez besoin d'un service ?<br>Nous sommes là pour vous.</h2>
			<a href="{{ route('register') }}" class="btn btn-outline btn-xl">Commençez dès maintenant!</a>
		</div>
	</div>
	<div class="overlay"></div>
</section>

<section class="cta bg-f">
	<div class="cta-content">
		<div class="container">
			<h2>Vous avez un service à offrir?<br>Nous sommes là pour vous.</h2>
			<a href="register" class="btn btn-outline btn-xl">Commençez dès maintenant!</a>
		</div>
	</div>
	<div class="overlay"></div>
</section>

<section id="contact">
	<div class="row">
		<div class="col-lg-12 text-center">
			<div class="section-heading">
				<h2>Contacter-nous</h2>
				<hr>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-area">  
					<form role="form">
						<br style="clear:both">
						<div class="form-group">
							<input type="text" class="form-control" id="name" name="name" placeholder="nom" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Numéro de téléphone" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Objet" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="200" rows="7"></textarea>
							<span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
						</div>

						<button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Envoyer</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="social-media" class="contact bg-pattern">
	<div class="container">
		<h2>Suivez-nous sur les réseaux sociaux</h2>
		<ul class="list-inline list-social">
			<li class="social-twitter">
				<a href="#"><i class="fa fa-twitter"></i></a>
			</li>
			<li class="social-facebook">
				<a href="#"><i class="fa fa-facebook"></i></a>
			</li>
			<li class="social-google-plus">
				<a href="#"><i class="fa fa-google-plus"></i></a>
			</li>
		</ul>
	</div>
</section>
@endsection
