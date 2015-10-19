<?php namespace App; 

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Kyslik\ColumnSortable\Sortable;



class Societe extends Model {

	//

	use SearchableTrait, Sortable;

	protected $guarded = ['timestamps'];

	protected $searchable;

	 protected $sortable = [
                           'nom_clt',
                           'pays_clt',
                           'ville_siege_clt',
                           'statut', 
                           'created_at', 
                           'updated_at']; 

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
