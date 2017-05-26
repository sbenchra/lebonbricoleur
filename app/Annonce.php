<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Metier;

class Annonce extends Model
{
	/*protected $fillable = [
        'titre', 'descritption', 'budget_inital', 'date_limite', 'user_id'
    ];*/
    public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function metiers()
    {
	return $this->belongsToMany(Metier::class);
    }

    public function bricoleurs()
    {
		return $this->belongsToMany(User::class);
    }

    public function bricoleurs_interested() {
        return $this->belongsToMany(User::class)->wherePivot('valide', false)->withPivot('budget', 'date_limite', 'valide');
    }

    public function bricoleurs_choosed() {
        return $this->belongsToMany(User::class)->wherePivot('valide', true)->withPivot('budget', 'date_limite');
    }
}
