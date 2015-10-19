<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Requests\CreateSocieteRequest;
use App\Http\Requests\CreateContactRequest;
use App\Http\Controllers\Controller;

use App\Societe;
use App\Contact;
use DB;
use App\Http\Controllers\Pays;

use Illuminate\Http\Request;
use Illuminate\Html\FormFacade;


class ContactController extends Controller {

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
		$contacts = new Contact;
		$actif = 'contact';
		$type = 1;
		if(isset($_GET['sort'])){
			if($_GET['sort']=='pays_clt'){
				$contact = DB::table('contacts')
							->leftjoin('societes','contacts.societe_id','=','societes.id')
							->orderBy('societes.pays_clt',$_GET['order'])->where('contacts.etat',1)->get();
				$tri = 'pays';
			}elseif($_GET['sort']=='statut'){
				$contact = DB::table('contacts')
							->leftjoin('societes','contacts.societe_id','=','societes.id')
							->orderBy('societes.statut',$_GET['order'])->where('contacts.etat',1)->get();
				$tri = 'client';
			}elseif($_GET['sort']=='created_at'){
				$tri = 'ajout';
				$contact = $contacts->with('societe')->where('etat',1)->sortable()->get();
			}elseif($_GET['sort']=='updated_at'){
				$tri = 'modif';
				$contact = $contacts->with('societe')->where('etat',1)->sortable()->get();
			}elseif($_GET['sort']=='nom_contact'){
				$tri = 'alpha';
				$contact = $contacts->with('societe')->where('etat',1)->sortable()->get();
			}elseif($_GET['sort']=='societe_id'){
				$contact = DB::table('contacts')
							->leftjoin('societes','contacts.societe_id','=','societes.id')
							->orderBy('societes.nom_clt',$_GET['order'])->where('contacts.etat',1)->get();
				$tri = 'societe';
			}elseif($_GET['sort']=='ville_siege_clt'){
				$contact = DB::table('contacts')
							->leftjoin('societes','contacts.societe_id','=','societes.id')
							->orderBy('societes.ville_siege_clt',$_GET['order'])->where('contacts.etat',1)->get();
				$tri = 'ville';
			}	
			
		}else{
			$tri = 'alpha';
			$contact = $contacts->with('societe')->where('etat',1)->orderBy('nom_contact','asc')->get();
		}
		return view('contact.contact', compact('actif','contact','type','tri'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$actif = 'contact';
		return view('contact.create-contact',compact('actif'));
		
	}

		public function creercontact($id)
	{
		$actif = 'contact';
		$societe = Societe::select('nom_clt')->findOrFail($id);

		return view('contact.creer-contact',compact('actif','id','societe'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateContactRequest $request)
	{
		$actif ='contact';
		foreach ($request->all() as $key => $value) {
			if($key != 'add_again'){
				$data[$key] = $value;
			}
		}	
	
		Contact::create($data);

		$id = DB::table('contacts')->select('id')->orderBy('id', 'desc')->first();
			foreach ($id as $value) {
				$id = $value;
			}

		if($request->societe_id){
			
			if($request->add_again){
				return redirect(route('creer.contact',$request->societe_id));
			}else{
				return  redirect(route('contact.show',$id));
			}
		}else{
			return  redirect(route('contact.show', $id));
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
		$actif = 'contact';
		$contact = Contact::findOrFail($id);
		$ListNote = Contact::findOrFail($id)->notes()->where('etat',1)->get();
		return view('contact.profil-contact',compact('actif','contact','ListNote'));
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$actif ='contact';
		$contact = Contact::findOrFail($id);
		return view('contact.edit-contact',compact('actif','contact'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateContactRequest $request)
	{
		//
		$contact = Contact::findOrFail($id);
		$contact->update($request->all());
		return  redirect(route('contact.show', $id));
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
		$contact = Contact::findOrFail($id);
		$contact->update(['etat'=>0]);

		

		$id = $contact->societe_id;
		
		if($id != 0){
			return  redirect(route('societe.show',$id));
		}else{
			return redirect(route('contact.index'));
		}
	}

	/**
	 * Return Contact Sort to View.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function TriContact($tripar)
		{
			//

			$actif = 'contact';
			$type = 1;
			
			if($tripar=='pays'){
				$contact = DB::table('contacts')
							->leftjoin('societes','contacts.societe_id','=','societes.id')
							->orderBy('societes.pays_clt','asc')->where('contacts.etat',1)->get();
				$tri = 'pays';
			}elseif($tripar=='notes'){
				$contact = Contact::where('etat',1)->orderBy('pays_clt','asc')->get();
				$tri = 'notes';
			}elseif($tripar=='groupe'){
				$contact = DB::table('contacts')
								->leftjoin('groupes','contacts.groupe_id','=','groupes.id')
								->leftjoin('societes','contacts.societe_id','=','societes.id')
								->orderBy('groupes.nom_groupe','asc')->where('contacts.etat',1)->get();
			$tri = 'groupe';

			dd($contact);
			}elseif($tripar=='ajout'){
				$contact = Contact::where('etat',1)->orderBy('created_at','desc')->get();
				$tri = 'ajout';
			}elseif($tripar=='modification'){
				$contact = Contact::where('etat',1)->orderBy('updated_at','desc')->get();
				$tri = 'modif';
			}elseif($tripar=='alpha'){
				$contact = Contact::where('etat',1)->orderBy('nom_contact','desc')->get();
				$tri = 'alpha';
			}
			elseif($tripar=='client'){
				$contact = Contact::where('etat',1)->orderBy('nom_contact','asc')->get();
				$tri = 'client';
			}
			
			return view('contact.contact', compact('actif','contact','type','tri'));
		}

}
