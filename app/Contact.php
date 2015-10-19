<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model {

	use SearchableTrait, Sortable;

	//
	protected $guarded = ['timestamps'];

	protected $searchable;

	public function setSearchable($value)
	{
	      $this->searchable = $value;
	}

	protected $sortable = [
                           'nom_contact',
                           'societe_id',
                           'pays_clt',
                           'ville_siege_clt',
                           'statut', 
                           'created_at', 
                           'updated_at']; 

	
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
