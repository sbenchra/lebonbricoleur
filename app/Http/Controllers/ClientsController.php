<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;



class ClientsController extends Controller
{
    
    public function index()
    {
        $clients = Client::orderBy('id', 'nom')->get();
        return view('clientCRUD.index',compact('clients') );

    }

    public function show($id)
    {
        $client = Client::find($id);
        return view('clientCRUD.show',compact('client') );

    }

    public function create()
    {
        $clients = Client::orderBy('id', 'nom')->get();
        return view('clientCRUD.create',compact('clients'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
       // dd($client);
          $client = Client::find($client->id);

        // show the edit form and pass the nerd
        return View('clientCRUD.edit')
            ->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
       //dd($client);
        //dd($request);
    /*
          $rules = array(
            'name'       => 'required',
            'prenom'      => 'required',
            'email' => 'email',
            'tel' => 'numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {

            return Redirect::to('client/' . $client->id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));

        } else {
    */
            // store
            $client = Client::find($client->id);
            $client->nom         = Input::get('nom');
            $client->prenom      = Input::get('prenom');
            $client->save();

            // redirect
            \Session::flash('message', 'Le client a été correctement modifié!');
            return Redirect::to('client');
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
       // dd($client->id);
        \Session::flash('message', 'Le client a été correctement supprimé!'); 
        $client->delete();
        
        return back();
    
    }
}
