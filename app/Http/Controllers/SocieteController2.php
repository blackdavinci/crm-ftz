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



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$societe = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
		$actif = 'contact';
		$type = 0;
		$tri = 'none';
		return view('contact.contact', compact('actif','societe','type','tri'));
	}

	/**
	 * Display societe by list 
	 *
	 * @return Response
	 */
	public function liste()
	{
		$grille = 1;
		$societe = Societe::where('etat',1)->get();
		return view('contact.affichage-liste-contact',compact('societe','grille'));
	}

	public function grille()
	{
		$grille = 1;
		$societe = Societe::where('etat',1)->get();
		return view('contact.affichage-grille-contact',compact('societe','grille'));
				
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
		$groupe['null'] = '';
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->get();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
				
		return view('contact.create-societe',compact('actif','groupe'));
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

		Societe::create($request->all());
		$id = DB::table('societes')->select('id')->orderBy('id', 'desc')->first();
		foreach ($id as $value) {
			$id = $value;
		}
	
		$params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		$params['index'] = 'ftz';
		$params['type']  = 'societes';
		$params['id']    = $id;

		$indexes = $client->index($params);

		$actif ='contact';
		return redirect('societe');

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
		$profil = Societe::with('groupe')->findOrFail($id);
		$ListContact = Societe::findOrFail($id)->contact()->where('etat',1)->get();
		//var_dump($profil);
		// dd();
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
		$ListGroupeCRM = DB::table('groupes')->select('id','nom_groupe','date_groupe')->get();
		foreach ($ListGroupeCRM as $key => $value) {
			$groupe[$value->id] = $value->nom_groupe.' '.$value->date_groupe;
		}
		return view('contact.edit-societe',compact('actif','profil','groupe'));
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

		$params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		$params['index'] = 'ftz';
		$params['type']  = 'societes';
		$params['id']    = $id;

		$indexes = $client->index($params);

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
				$societe = Societe::where('etat',1)->orderBy('pays_clt','asc')->get();
				$tri = 'pays';
			}elseif($tripar=='notes'){
				$societe = Societe::where('etat',1)->orderBy('pays_clt','asc')->get();
				$tri = 'notes';
			}elseif($tripar=='groupe'){
				$societe = DB::table('societes')
								->leftjoin('groupes','societes.groupe_id','=','groupes.id')
								->orderBy('groupes.nom_groupe','asc')->where('societes.etat',1)->get();
			$tri = 'groupe';
			}elseif($tripar=='ajout'){
				$societe = Societe::where('etat',1)->orderBy('created_at','desc')->get();
				$tri = 'ajout';
			}elseif($tripar=='modification'){
				$societe = Societe::where('etat',1)->orderBy('updated_at','desc')->get();
				$tri = 'modif';
			}elseif($tripar=='alpha'){
				$societe = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
				$tri = 'alpha';
			}
			elseif($tripar=='client'){
				$societe = Societe::where('etat',1)->orderBy('nom_clt','asc')->get();
				$tri = 'client';
			}
			
			return view('contact.contact', compact('actif','societe','type','tri'));
		}
	}
