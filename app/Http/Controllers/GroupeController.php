<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateGroupeRequest;
use App\Http\Controllers\Controller;

use App\Groupe;
use App\Societe;
use DB;

use Illuminate\Http\Request;

class GroupeController extends Controller {

	/* Authentification function */
	
	public function __construct()
	{
	    $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$groupes = new Groupe;
		$actif = 'contact';

		$type = 2;

		if(isset($_GET['sort'])){
			if($_GET['sort']=='nom_groupe'){
				$tri = 'alpha';
				$groupe = $groupes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='type_groupe'){
				$tri = 'type';
				$groupe = $groupes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='created_at'){
				$tri = 'ajout';
				$groupe = $groupes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='updated_at'){
				$tri = 'modif';
				$groupe = $groupes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='date_groupe'){
				$tri = 'date';
				$groupe = $groupes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='ville_siege_clt'){
				$tri = 'ville';
				$societe = $societes->sortable()->where('etat',1)->get();
			}
		}else{
			$tri = 'alpha';
			$groupe = $groupes->where('etat',1)->orderBy('nom_groupe','asc')->get();
		}


		return view('contact.contact',compact('actif','type','groupe','tri'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$actif = 'contact'; 

		return view('contact.create-group-crm',compact('actif'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateGroupeRequest $request)
	{
		//
		Groupe::create($request->all());
		return redirect('groupe');

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
		
		$groupe = Groupe::findOrFail($id);
		$actif = 'contact';
		$type = 3;
		$tri = 'none';
		if(isset($_GET['sort'])){
			if($_GET['sort']=='pays_clt'){
				$tri = 'pays';
				$societe = Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='statut'){
				$tri = 'client';
				$societe =Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='created_at'){
				$tri = 'ajout';
				$societe = Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='updated_at'){
				$tri = 'modif';
				$societe = Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='nom_clt'){
				$tri = 'alpha';
				$societe = Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='ville_siege_clt'){
				$tri = 'ville';
				$societe = Groupe::findOrFail($id)->societe()->sortable()->where('etat',1)->get();
			}elseif('notes'){
				$match= ['societes.etat'=>1,'societes.groupe_id'=>$id];
				$note = DB::table('societes')
				            ->join('contacts', 'societes.id', '=', 'contacts.societe_id')
				            ->join('notes', 'contacts.id', '=', 'notes.contact_id')
				            ->select('societes.*', 'notes.*')->where($match)
				            ->get();
				$societes = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
				$tri = 'notes';

				// Tri des contacts sans note
				foreach ($societes as $key => $value) {
					$exist = 0;
					foreach ($note as $keyn => $valuen) {
						if($value->nom_clt == $valuen->nom_clt){
							$exist = 1;
						}
					}

					if($exist==0){
						$societe [] = $value;
					}
						
				}
			}	
			
		}else{
			$tri = 'alpha';
			$societe = Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('nom_clt','asc')->get();
		}
		
		return view('contact.contact', compact('actif','societe','type','tri','groupe'));
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
		$actif = 'contact'; 
		$profil = Groupe::findOrFail($id);
		return view('contact.edit-groupe-crm',compact('actif','profil'));
	}

	/**** Fonction de tri ******/
	public function Trigroupe($tripar,$id)
		{
			//
			$actif = 'contact';
			$type = 3;
			
			if($tripar=='pays'){
				$societegr  =  Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('pays_clt','asc')->get();
				$tri = 'pays';
			}elseif($tripar=='notes'){

				$note = DB::table('societes')
				            ->join('contacts', 'societes.id', '=', 'contacts.societe_id')
				            ->join('notes', 'contacts.id', '=', 'notes.contact_id')
				            ->select('societes.*', 'notes.*')->where('societes.etat',1)
				            ->get();
				$societes = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
				$tri = 'notes';

				// Tri des contacts sans note
				foreach ($societes as $key => $value) {
					$exist = 0;
					foreach ($note as $keyn => $valuen) {
						if($value->nom_clt == $valuen->nom_clt){
							$exist = 1;
						}
					}

					if($exist==0){
						$societegr [] = $value;
					}
						
				}

			}elseif($tripar=='ajout'){
				$societegr  =  Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('created_at','asc')->get();
				$tri = 'ajout';
			}elseif($tripar=='modification'){
				$societegr  = Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('udpated_at','asc')->get();
				$tri = 'modif';
			}elseif($tripar=='alpha'){
				$societegr  =  Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('nom_clt','desc')->get();
				$tri = 'alpha';
			}
			elseif($tripar=='client'){
				$societegr  = Groupe::findOrFail($id)->societe()->where('etat',1)->orderBy('statut','asc')->get();
				$tri = 'client';
			}
			
			
			return view('contact.contact', compact('actif','societegr','type','tri','note'));
		}
	



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateGroupeRequest $request)
	{
		//

		$profil = Groupe::findOrFail($id);
		$profil->update($request->all());

		return  redirect(route('groupe.show', $id));
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
		$groupe = Groupe::findOrFail($id);
		$groupe->update(['etat'=>0]);

		return redirect(route('groupe.index'));
	}

}
