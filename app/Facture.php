<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model {

	//
	protected $guarded = ['timestamps'];

	public function societedata(){
		return $this->belongsTo('App\SocieteData');
	}

	public function devis(){
        return $this->belongsTo('App\Devis');
    }

    public function livraison(){
        return $this->belongsTo('App\Livraison');
    }

    public function contact(){
		return $this->belongsTo('App\Contact');
    }

    public function societe(){
		return $this->belongsTo('App\Societe');
    }

    public function gescom(){
        return $this->belongsTo('App\Gescom');
    }

    public function modules(){
        return $this->belongsToMany('App\Module')->withPivot('quantite','produit_id','service_duree')->withTimestamps();
    }


}
