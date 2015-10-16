<?php namespace App; 

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;



class Societe extends Model {

	//

	use SearchableTrait;

	protected $guarded = ['timestamps'];

	protected $searchable;

	public function setSearchable($value)
	{
	      $this->searchable = $value;
	}

	public function contacts(){

		return $this->hasMany('App\Contact');
	}

    public function devis(){

        return $this->hasMany('App\Devis');
    }

    public function groupe(){

        return $this->belongsTo('App\Groupe');
    }

  
}
