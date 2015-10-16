<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

	//
	protected $guarded = ['timestamps'];
	
	// public function produit(){

	// 	return $this->belongsTo('App\Produit');
	// }

	public function produits(){
		return $this->belongsToMany('App\Produit');
	}

	public function devis(){
		return $this->belongsToMany('App\Devis');
	}

	public function livraisons(){
		return $this->belongsToMany('App\Livraison');
	}

	public function getProduitListAttribute(){
		if($this->id){
			return $this->produits->lists('id')->toArray();
		}
		
	}

	
}
