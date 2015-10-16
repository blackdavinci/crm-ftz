<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Contact extends Model {

	use SearchableTrait;

	//
	protected $guarded = ['timestamps'];

	protected $searchable;

	public function setSearchable($value)
	{
	      $this->searchable = $value;
	}


	
	public function societe(){

		return $this->belongsTo('App\Societe');
	}

	public function groupe(){

		return $this->belongsTo('App\Groupe');
	}
	
	public function devis(){

        return $this->hasMany('App\Devis');
    }

	public function notes(){

		return $this->hasMany('App\Note');
	}
}
