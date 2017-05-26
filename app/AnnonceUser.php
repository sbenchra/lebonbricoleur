<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Annonce;
class AnnonceUser extends Model
{
    protected $table = "annonce_user";

    public function getBricoleurs() {
    	return App\User::where('id', $this->user_id)->get();
    }

    public function getAnnonce() {
    	return Annonce::where('id', $this->annonce_id)->first();
    }

    public function getClient() {
    	return App\User::where('id', $this->getAnnonce()->user_id)->get();
    }
}
