<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model {

	//
	protected $guarded = ['timestamps'];

	// public function modules(){

	// 	return $this->hasMany('App\Module');
	// }

	public function modules(){
		return $this->belongsToMany('App\Module');
	}

}
