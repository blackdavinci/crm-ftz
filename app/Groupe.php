<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Groupe extends Model {

	use Sortable;

	protected $sortable = [
                           'nom_groupe',
                           'date_groupe',
                           'type_groupe',
                           'pays_clt',
                           'created_at', 
                           'updated_at']; 

	protected $guarded = ['timestamps'];

	public function societes(){
        return $this->belongsToMany('App\Societe')->withTimestamps();
    }


	public function contact(){
		return $this->hasMany('App\Contact');
	}
	
}
