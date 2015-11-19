<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateSocieteRequest;
use App\Http\Requests\CreateContactRequest;
use App\Http\Controllers\Controller;

use Elasticsearch\Client;
use App\Societe;
use App\Contact;
use App\Groupe;
use SearchIndex;
use DB;


use Illuminate\Http\Request;
use Illuminate\Html\FormFacade;

class SocieteController extends Controller {


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
		$societes = new Societe;
		


		//$societe = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
		$actif = 'contact';
		$type = 0;
		if(isset($_GET['sort'])){
			if($_GET['sort']=='pays_clt'){
				$tri = 'pays';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='statut'){
				$tri = 'client';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='created_at'){
				$tri = 'ajout';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='updated_at'){
				$tri = 'modif';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='nom_clt'){
				$tri = 'alpha';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif($_GET['sort']=='ville_siege_clt'){
				$tri = 'ville';
				$societe = $societes->sortable()->where('etat',1)->get();
			}elseif('notes'){
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
						$societe [] = $value;
					}
						
				}
			}	
			
		}else{
			$tri = 'alpha';
			$societe = $societes->where('etat',1)->orderBy('nom_clt','asc')->get();
		}
		
		return view('contact.contact', compact('actif','societe','type','tri'));
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		//
		$actif='contact';
		$groupes = [];
		$groupe['null'] = 'Choisissez le groupe auquel appartient la société';
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->where('etat',1)->get();

		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
				
		return view('contact.create-societes',compact('actif','groupe'));
	}

	public function creersociete()
	{

		//
		$actif='contact';
		$groupes = [];
		
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->where('etat',1)->get();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
				
		return view('contact.create-societes',compact('actif','groupe'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function checksociety(Request $request)
	{

		//
		return ('Hello');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSocieteRequest $request)
	{
		//
		$client = new Client();
		$params = array();
		$societecheck = $request->input('nom_clt');

		$check = DB::table('societes')->select('nom_clt')->where('nom_clt',$societecheck)->count();

		if($check==0 ){

			$data = $request->except(['groupe_id','add_contact']);	

			$societe = Societe::create($data);

			$societe->groupes()->sync($request->input('groupe_id'));

			$id = DB::table('societes')->select('id')->orderBy('id', 'desc')->first();
			foreach ($id as $value) {
				$id = $value;
			}
			
			// $params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

			// $params['index'] = 'ftz';
			// $params['type']  = 'societes';
			// $params['id']    = $id;

			// $indexes = $client->index($params);

			$actif ='contact';
			if($request->input('add_contact')){
				return redirect(route('creer.contact',$id));
			}else{
				return redirect(route('societe.show',$id));	
			}
			
		}else{
			return redirect('creer-societe')->withInput()->withErrors('Société Déjà existante');
		}
		
		
		
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
		$actif ='contact';
		$profil = Societe::findOrFail($id);
		$ListContact = Societe::findOrFail($id)->contacts()->where('etat',1)->get();
		
		return view('contact.profil-societe',compact('actif','profil','ListContact'));
	}

	/**
	 * Display the research results.
	 *
	 * @return Response
	 */
	public function search(Request $request)
	{
		$actif = 'contact';
		$grille = 0;
		$q = $request->input('q');
		$client = new Client();

		 $params['index'] = 'ftz';
		 $params['type']  = 'societe';
		 $params['body']['query']['bool']['should'] = [
		     ['prefix' => ["societe"=>$q]],
		     ['prefix' => ["pays"=>$q]]
		 ];

		 $query = $client->search($params);
		$results = $query['hits']['hits'];
		
		return view('contact.contact',compact('actif','results','grille'));
	}

	/**
	 * Display the research results.
	 *
	 * @return Response
	 */
	public function searchable(Request $request)
	{
		$query = $request->q;
		$societe = Societe::search($query)
					->with('contacts')
					->get();
		$contacts = 
		$contact =  Contact::search($query)->get();
		$type = 0;
		$tri = 'none';
		$actif = 'contact';
		// foreach ($societe as $key => $value) {
		// 	var_dump($value->nom_contacts);
		// }
		// dd();
		
	
		return view('contact.contact', compact('actif','societe','type','tri','query'));
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
		$actif ='contact';
		$groupe = [];
		$groupe['null'] = '';
		$profil = Societe::findOrFail($id);
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->where('etat',1)->get();
		$groupes_list = $profil->groupes->lists('id')->toArray();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
		return view('contact.edit-societe',compact('actif','profil','groupe','groupes_list'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateSocieteRequest $request)
	{
		//
		$client = new Client();
		$params = array();

		$profil = Societe::findOrFail($id);
		$profil->update($request->all());

		$profil->groupes()->sync($request->input('groupe_id'));

		// $params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		// $params['index'] = 'ftz';
		// $params['type']  = 'societes';
		// $params['id']    = $id;

		// $indexes = $client->index($params);

		return  redirect(route('societe.show', $id));
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
		
		$contacts = Societe::findOrFail($id)->contacts()->select('id')->where('etat',1)->get();
		if(!empty($contacts->id)){
			foreach ($contacts as $value) {
			$contact = Contact::findOrFail($value->id);
			$contact->update(['etat'=>0]);
			}
			foreach ($contact as $value) {
					$contact->update(['etat'=>0]);
			}
		}
	
		$profil = Societe::findOrFail($id);
		$profil->update(['etat'=>0]);
		return  redirect(route('societe.index'));
	}
	/**
	 * Remove the selected resources from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function destroyselect($data)
		{
			//

			var_dump($data);
			dd();
			//return $data;
		}

	/**
	 * Return Societe Sort to View.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function TriSociete($tripar)
		{
			//
			$actif = 'contact';
			$type = 0;
			
			if($tripar=='pays'){
				//$societe = Societe::where('etat',1)->orderBy('pays_clt','asc')->get();
				$societes = new Societe;
				$type = 4;
				$societe = $societes->sortable()->where('etat',1)->get();
				$tri = 'pays';
				return view('contact.contact', compact('actif','societe','type','tri'));
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
						$societe [] = $value;
					}
						
				}
				
			}elseif($tripar=='groupe'){
				$societe = DB::table('groupes')
								->rightjoin('societes','societes.groupe_id','=','groupes.id')
								->orderBy('groupes.nom_groupe','asc')->where('societes.etat',1)->get();
				
								foreach ($societe as $value) {
									echo $value->nom_clt.' => '.$value->nom_groupe.' => '.$value->statut.'<br/>';
								}
								dd();
				
				$categorie = Societe::where('etat',1)->orderBy('statut','asc')->get();
			$tri = 'groupe';

			return view('contact.contact', compact('actif','societe','type','tri','categorie','groupe'));

			}elseif($tripar=='ajout'){
				$societe = Societe::where('etat',1)->orderBy('created_at','desc')->get();
				$tri = 'ajout';
			}elseif($tripar=='modification'){
				$societe = Societe::where('etat',1)->orderBy('updated_at','desc')->get();
				$tri = 'modif';
			}elseif($tripar=='alpha'){
				$societe = Societe::where('etat',1)->orderBy('nom_clt','desc')->get();
				$tri = 'alpha';
			}
			elseif($tripar=='client'){
				$societe = Societe::where('etat',1)->orderBy('statut','asc')->get();
				$tri = 'client';
			}
			
			return view('contact.contact', compact('actif','societe','type','tri','note'));
		}
	}
