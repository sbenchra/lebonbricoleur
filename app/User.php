<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ville', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function metiers() {
        return $this->belongsToMany(Metier::class);
    }

    //Interested in
    public function annonces()
    {
        return $this->belongsToMany(Annonce::class);
    }

    public function valide($annonce_id)
    {   // return $this->wherePivot('post_id',$post_id);
        $this->annonces()->updateExistingPivot($annonce_id,['valide' => 1]);
    }

    public function getReviews() {
        return Review::where('bricoleur_id', $this->id)->get();
    }

    public static function clients() {
        return User::where('role',2);
    }

    public static function bricoleurs() {
        return User::where('role',1);
    }

    public static function bricoleurWithReviews($id) {
        return User::find($id)->reviews;
    }

    public function getScore() {
        return Review::where('bricoleur_id', $this->id)->avg('score');
    }
}
