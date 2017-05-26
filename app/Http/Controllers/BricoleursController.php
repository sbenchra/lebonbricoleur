<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BricoleursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bricoleurs = User::orderBy('created_at', 'nom')->get();
        return view('bricoleurCRUD.index',compact('bricoleurs') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $tags = Tag::orderBy('nom')->get();
        //dd($tags);
        $bricoleurs = User::orderBy('id', 'nom')->get();
        return view('bricoleurCRUD.create',compact('bricoleurs','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$rules = array(
            'nom'       => 'required',
            'prenom'      => 'required',
            'email'      => 'required|email',
            'tel'      => 'required|numeric'


        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('bricoleur/create');
            //    ->withErrors($validator)
            //    ->withInput(Input::except('password'));
        } else {
            */
            // store

            
            $bricoleur = new User;

            $bricoleur->nom     = $request->nom ;
            $bricoleur->prenom      = $request->prenom ;
            $bricoleur->desc      = $request->desc ;
            $bricoleur->adresse      = $request->adresse ;
            $bricoleur->email      = $request->email ;
            $bricoleur->tel      = $request->tel ;
            $bricoleur->password = "" ;

            $bricoleur->save();
            // dd($bricoleur);

            //dd($request->selected);
            foreach ($request->selected as $tagname) {
                $tag = Tag::where('nom',$tagname)->get() ;

                $bricoleur->tags()->attach($tag); 

            }

            

            // redirect
            \Session::flash('message', 'User creé avec succès!');
            return Redirect::to('bricoleur');

        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bricoleur  $bricoleur
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
         $intid = (int)$id;
        $bricoleur = User::find($intid);

        //dd($bricoleur->reviews);

        //dd($bricoleur);
        return view('bricoleurCRUD.show')->with('bricoleur',$bricoleur);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bricoleur  $bricoleur
     * @return \Illuminate\Http\Response
     */
    public function edit(User $bricoleur)
    {
        // dd($bricoleur);
          $bricoleur = User::find($bricoleur->id);

        // show the edit form and pass the nerd
        return View('bricoleurCRUD.edit')
            ->with('bricoleur', $bricoleur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bricoleur  $bricoleur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bricoleur $bricoleur)
    {
        
       //dd($post);
        //dd($request);
    
          $rules = array(
            'nom'       => 'required',
            'prenom'      => 'required'
            );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {

            return Redirect::to('bricoleur/' . $bricoleur->id . '/edit');
                //->withErrors($validator)
                //->withInput(Input::except('password'));

        } else {
    
            // store
            $bricoleur = User::find($bricoleur->id);
            $bricoleur->nom         = Input::get('nom');
            $bricoleur->prenom         = Input::get('prenom');
            $bricoleur->tel         = Input::get('tel');
            $bricoleur->email         = Input::get('email');
            $bricoleur->adresse         = Input::get('adresse');
            $bricoleur->desc      = Input::get('desc');
            $bricoleur->save();

            // redirect
            \Session::flash('message', 'Le bricoleur a été correctement modifié!');
            return Redirect::to('bricoleur');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bricoleur  $bricoleur
     * @return \Illuminate\Http\Response
     */
    public function destroy(bricoleur $bricoleur)
    {
         \Session::flash('message', 'Le bricoleur a été correctement supprimé!'); 
        $bricoleur->delete();
        
        return Redirect::to('bricoleur');
    }
}
