<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('landing.index');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::post('/annonces/{id}/validation', 'AnnoncesController@validation');
Route::get('/annonces/getLastFive', 'AnnoncesController@getLastFive');
Route::get('/annonces/stats', 'AnnoncesController@stats');
Route::resource('/annonces', 'AnnoncesController');
Route::resource('/metiers', 'MetiersController');
Route::resource('/annonce-user', 'AnnonceUserController');
Route::resource('/bricoleurs', 'BricoleursController');
Route::resource('/review', 'ReviewsController');

/*Route::post('/metiers', function(Request $request) {
	//dd($request->metiers);
	$user = Auth::user();
	foreach ($request->metiers as $metier) {
		$metier = Metier::where('name',$metier)->get() ;
        $user->metiers()->attach($metier); 
	}

	return ['message' => true];
});*/

Route::get('/dashboard/offres', function() {
	$metiers = App\Metier::all();
	return view('dashboards.offres', compact('metiers'));
})->name('offres')->middleware('auth');

Route::get('/users', function() {
	$users = App\User::all();
	$usernames = [];
	foreach ($users as $user) {
		$usernames[] = $user->name;
	}
	return $usernames;
});

Route::get('/dashboard/api/pending', 'AnnonceUserController@waitingForValidation');
Route::get('/dashboard/api/done', 'AnnonceUserController@done');
Route::get('/dashboard/api/pending_client', 'AnnoncesController@getEnCours');
Route::get('/dashboard/api/done_client', 'AnnoncesController@done');
Route::get('/dashboard/test', 'AnnoncesController@done');
Route::get('/dashboard/pending', function() {
	$metiers = App\Metier::all();
	if (\Auth::user()->role === App\Roles::BRICOLEUR) {
		return view('dashboards.waitingForValidation', compact('metiers'));
	} else {
		return view('dashboards.encours', compact('metiers'));
	}
})->name('pending');

Route::get('/dashboard/done', function() {
	$metiers = App\Metier::all();
	if (\Auth::user()->role == App\Roles::BRICOLEUR) {
		return view('dashboards.done', compact('metiers'));
	} else {
		return view('dashboards.c_done', compact('metiers'));
	}
})->name('done');

Route::get('/interested/{id}/choosed', 'AnnonceUserController@getTheOneAndOnly');
Route::get('/interested/{id}/choosed/rating', 'AnnonceUserController@getRating');
Route::get('/interested/{id}', 'AnnoncesController@interested');



