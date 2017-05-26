<?php

namespace App\Http\ Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Metier;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $metiers = Metier::all();
        if ($user->role === Roles::BRICOLEUR) {
            $id = $user->id;
            return view('dashboards.b_dashboard', ['metiers' => $metiers, 'user_id' => $id]);
        } 

        

        return view('dashboards.c_dashboard', ['metiers' => $metiers]);
    }
}
