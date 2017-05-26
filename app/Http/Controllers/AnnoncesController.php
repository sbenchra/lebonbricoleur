<?php

namespace App\Http\Controllers;

use App\User;
use App\Annonce;
use App\Metier;
use Illuminate\Http\Request;
use App\Roles;
use App\AnnonceUser;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class AnnoncesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if ($user->role === Roles::BRICOLEUR) {
            $annonces = [];
            foreach ($user->metiers as $metier) {
                //$annonces[$metier->name] = $metier->annonces;
                foreach ($metier->annonces as $annonce) {
                    $c = AnnonceUser::where('annonce_id', $annonce->id)->where('user_id', \Auth::id())->count();
                    if ($c == 0) {
                        $annonces[$metier->name][] = $annonce;
                    }
                }
            }
        } else {
            $annonces = Annonce::with('metiers')->where('user_id', \Auth::id())->orderBy('created_at', 'titre')->get();
        }
        return $annonces;
    }

    public function getLastFive() {
        $user = \Auth::user();
        $annonces = Annonce::with('metiers')->where('user_id', \Auth::id())->orderBy('created_at', 'titre')->limit(4)->get();
        return $annonces;
    }

    public function done() {
        $annonces_user = AnnonceUser::where('valide', true)->get();
        $result = [];
        foreach ($annonces_user as $annonce) {
            if ($annonce->getAnnonce()->user_id === \Auth::id()) {
                $result[] = $annonce->getAnnonce();
                //$ids[] = $annonce->getAnnonce()->id;
            }
        } 

        return $result;
    }

    public function getEnCours() {
        $annonces_user = AnnonceUser::where('valide', false)->get();
        $annonces_user_2 = AnnonceUser::where('valide', true)->get();
        $result = [];
        $ids = [];
        foreach ($annonces_user as $annonce) {
            if ($annonce->getAnnonce()->user_id === \Auth::id()) {
                $result[] = $annonce->getAnnonce();
                $ids[] = $annonce->getAnnonce()->id;
            }
        }  

        foreach ($annonces_user_2 as $annonce) {
            if ($annonce->getAnnonce()->user_id === \Auth::id()) {
                //$result[] = $annonce->getAnnonce();
                $ids[] = $annonce->getAnnonce()->id;
            }
        } 

        // return \Item::whereNotIn('id', $ids)->get();

        $results = Annonce::whereNotIn('id', $ids)->get();
        foreach ($results as $r) {
            $result[] = $r;
        }
        return $result;
    }

    public function stats() {
        $user = \Auth::user();
        $count = Annonce::where('user_id', \Auth::id())->count();

        return ['count' => $count, 'encours' => count($this->getEnCours()), 'acheves' => count($this->done())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $annonce = new Annonce();
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;
        $annonce->adresse = $request->adresse;
        $annonce->user_id = \Auth::id();
        $annonce->budget_initial = $request->budget_initial;
        $annonce->date_limite = $request->date_limite;
        $res = $annonce->save();
        
        //In case the post can take multiple services
        //Uncomment this
        /*foreach ($request->metiers as $metier) {
            $metier = Metier::where('name',$metier)->get() ;
            $annonce->metiers()->attach($metier); 
        }*/

        $metier = Metier::where('name',$request->metiers)->get();
        $annonce->metiers()->attach($metier); 
        return json_encode(['message' => $res]);
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        $isValid = AnnonceUser::where('annonce_id', $annonce->id)->where('valide', true)->count() > 0 ? true : false;
        return view('annonces.show', compact('annonce', 'isValid'));
    }

    public function interested($id) {
         $b = Annonce::find(intval($id))->bricoleurs_interested()->get();
         $res = [];
         foreach ($b as $bf) {
             $res[] = $bf;
         }
         return $res;
    }

    public function validation($annonce_id , Request $request)
    {

     
        $intfid = intval( $request->bricoleur_id );
        $bricoleur = User::find($intfid);
        $bricoleur->valide($annonce_id);
        \Session::flash('message', 'Le bricoleur a été correctement validé!');
        return Redirect::to('/annonces/'.$annonce_id);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        $intfid = $request->bricoleur_id ;
        echo $intfid;
        $bricoleur = User::find($intfid);
        $bricoleur->valide($annonce->id);
        
        return ['message' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
