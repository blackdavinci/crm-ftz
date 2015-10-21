<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model {

	//
	protected $guarded = ['timestamps'];

	public function contact(){

		return $this->belongsTo('App\Contact');
	}

    public function societe(){

        return $this->belongsTo('App\Societe');
    }

    public function societedata(){

        return $this->belongsTo('App\SocieteData');
    }

    public function gescom(){

        return $this->belongsTo('App\Gescom');
    }

    public function modules(){
        return $this->belongsToMany('App\Module')->withPivot('produit_quantite', 'produit_remise','produit_id','service_duree')->withTimestamps();
    }
}
