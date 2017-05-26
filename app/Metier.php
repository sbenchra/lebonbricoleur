<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Annonce;
use App\User;
class Metier extends Model
{
    public function annonces()	
    {
    	return $this->belongsToMany(Annonce::class)->orderBy('created_at', 'desc');
    }

    public function users() {
    	return $this->belongsToMany(User::class);
    }
}
