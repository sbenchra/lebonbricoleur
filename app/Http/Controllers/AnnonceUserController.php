<?php

namespace App\Http\Controllers;

use App\AnnonceUser;
use Illuminate\Http\Request;
use App\Annonce;
class AnnonceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getTheOneAndOnly($id) {
        $b = Annonce::find(intval($id))->bricoleurs_choosed()->get();
         $res = [];
         foreach ($b as $bf) {
             $res[] = $bf;
         }
         //$rating = $b[0]->getScore();
         //$res[] =$rating; 
         return $res;

    }

    public function getRating($id) {
        $b = Annonce::find(intval($id))->bricoleurs_choosed()->get();
         $res = [];
         foreach ($b as $bf) {
             $res[] = $bf;
         }
         $rating = $b[0]->getScore();
         return ['rating' => $rating];
    }

    public function waitingForValidation() {
        $annonces_users = AnnonceUser::where('user_id', \Auth::id())->where('valide', false)->get();
        $annonces = [];
        foreach ($annonces_users as $a) {
            $annonces[] = Annonce::find($a->annonce_id);
        }
        
        return $annonces;
    }

    public function done() {
        $annonces_users = AnnonceUser::where('user_id', \Auth::id())->where('valide', true)->get();
        $annonces = [];
        foreach ($annonces_users as $a) {
            $annonces[] = Annonce::find($a->annonce_id);
        }
        
        return $annonces;
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
        $au = new AnnonceUser();

        $au->user_id = \Auth::id();
        $au->annonce_id = $request->annonce_id;
        $au->budget = $request->budget;
        $au->date_limite = $request->date_limite;

        $res = $au->save();

        return ['message' => $res];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function show(AnnonceUser $annonceUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AnnonceUser $annonceUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnonceUser $annonceUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnonceUser $annonceUser)
    {
        //
    }
}
