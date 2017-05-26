<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "user_user";
    public function clients()
    {
    	return $this->belongsTo(User::class);
    }

    public function bricoleurs()
    {
    	return $this->belongsToMany(User::class);
    }

	public function getRouteKeyName()
	{
		return 'nom' ;
	}

    public function getOwner()
    {
        return User::where('id',$this->client_id)->get();
    }
    public function getOwnerName(){
        return User::select('name')->where('id',$this->client_id)->get();
    }

}
