<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Note;
use App\Societe;
use App\Groupe;

use DB;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;


class RapportController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

$groupe['null'] = '';
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->get();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
		
		 $aa=null; 
	
	 
	$visite = Societe::where('etat',1)->where('groupe_id',$aa)->count();

	$presentation = DB::table('societes')
            	->join('contacts', 'societes.id', '=', 'contacts.societe_id')
            	->join('notes', 'contacts.id', '=', 'notes.contact_id')
            	->select('notes.*','contacts.nom_contact','societes.id AS ste')
            	->where('societes.groupe_id','=',$aa)
            	->where('societes.etat','=','1')
            	->where('notes.categorie','=','Réunion')
            	->count();

	
		$actif = 'rapport';
		return view('rapport.index', compact('actif','visite','presentation','groupe'));

	}

public function evenement(Request $request)
	{

		$groupe['null'] = '';
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->get();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
		$id=$request->input('groupe');
		$visite = Societe::where('etat',1)->where('groupe_id',$id)->count();

	$presentation = DB::table('societes')
            	->join('contacts', 'societes.id', '=', 'contacts.societe_id')
            	->join('notes', 'contacts.id', '=', 'notes.contact_id')
            	->select('notes.*','contacts.nom_contact','societes.id AS ste')
            	->where('societes.groupe_id','=',$id)
            	->where('societes.etat','=','1')
            	->where('notes.categorie','=','Réunion')
            	->count();

	$devis = DB::table('societes')
            	->join('devis', 'societes.id', '=', 'devis.societe_id')
            	->select('devis.*','societes.id AS ste')
            	->where('societes.groupe_id','=',$id)
            	->where('societes.etat','=','1')
            	->count();
	
		$actif = 'rapport';
		return view('rapport.event', compact('actif','visite','presentation','groupe','id','devis'));

	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
