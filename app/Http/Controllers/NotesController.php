<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Note; 
use DB;
use App\Contact;
use App\Societe;
use View;
use Auth;
use App\User;

class NotesController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$note_auj= Note::where('etat','1')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		$note_futur= Note::where('etat','1')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		$note_past= Note::where('etat','1')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);

		/*$notes= Note::orderBy('updated_at', 'desc')->get();*/
		$actif ='notes';

		return View::make('notes.index',compact('note_auj','note_futur','note_past','actif'));
	}


	public function noteContact($id,$back)
	{
	

		$notes=Note::where('etat','1')->where('contact_id',$id)->orderBy('updated_at', 'desc')->paginate(15);

		$actif ='notes';
		$contact = Contact::findOrFail($id);


		return view('notes.list-notes',compact('notes','back','actif','contact'));
	}

		public function noteSociete($id,$back)
	{
	
		$notes = DB::table('societes')
            	->join('contacts', 'societes.id', '=', 'contacts.societe_id')
            	->join('notes', 'contacts.id', '=', 'notes.contact_id')
            	->select('notes.*','contacts.nom_contact','societes.id AS ste')
            	->where('societes.id','=',$id)
            	->where('notes.etat','=','1')
            	->paginate(15);

            	

		$actif ='notes';
		$profil = Societe::findOrFail($id);

		return View::make('notes.notes-societe',compact('notes','back','actif','profil'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$actif ='notes';
		$contacts[''] = '';
		$user = User::select('id','name','prenom')->where('etat',1)->get();
		$contact = Contact::select('id','nom_contact','prenoms_contact')->where('etat',1)->get();

		// Remplissage du tableau des contacts 
		foreach ($contact as $key => $value) {
			$contacts[$value->id] = $value->nom_contact.' '.$value->prenoms_contact;
		}

		// Remplissage du tableau des utilisateurs 
		foreach ($user as $key => $value) {
			$users[$value->id] = $value->name.' '.$value->prenom;
		}
		$users[Auth::user()->id] = 'Moi';
		
		return view('notes.creer-note',compact('actif','contacts','users'));
	}

/* creation de notes a partir de contact en prenant l'id du contact en parametre */
	public function creerNote($id)
	{
		$actif ='notes';
		$user = User::select('id','name','prenom')->where('etat',1)->get();
		// Remplissage du tableau des utilisateurs 
				foreach ($user as $key => $value) {
					$users[$value->id] = $value->name.' '.$value->prenom;
				}
				$users[Auth::user()->id] = 'Moi';
		
		return view('notes.create',compact('actif','id','users'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$actif ='contact';
		$note = Note::create($request->all()); 
		$id = $request->contact_id;

		return  redirect(route('contact.show', $id));
		/*return redirect(route('notes.index'));
			return view('notes.create',compact('actif','note'));*/
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
		$actif ='notes';
		$note= Note::FindOrFail($id);
		return view('notes.aff_note',compact('note','actif'));

	}
/* affichage de la note a partir des contacts*/
	public function aficherNote($id,$back)
	{
		//
		$actif ='notes';
		$note= Note::with('contact','user')->findOrFail($id);
		
		//$contact = Contact::findOrFail($note->contact_id);
		//$profil= $contact->societe_id;
		
		return view('notes.aff_note',compact('note','actif','back','profil'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$actif ='notes';
		$note= Note::FindOrFail($id);
		return view('notes.edit',compact('note','actif'));

	}

/* Modification de la note a partir des contacts*/
	public function modifierNote($id,$back)
	{
		$actif ='notes';
		$note= Note::FindOrFail($id);
		return view('notes.edit',compact('note','actif','back'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$actif ='notes';

		$note= Note::FindOrFail($id);
		$note->update($request->all());
		/* a changer mettre la vue show normalement
		
			return redirect(route('afficher.note')); */
		return view('notes.aff_note',compact('note','actif'));
		

	}

	public function changerNote($id,Request $request,$back)
	{
		$actif ='notes';

		$note= Note::FindOrFail($id);
		$note->update($request->all());
		/* a changer mettre la vue show normalement
		
			return redirect(route('afficher.note')); */
		return view('notes.aff_note',compact('note','actif','back'));
		

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
		$note = Note::findOrFail($id);
		$note->update(['etat'=>0]);
		return  redirect(route('notes.index'));
	}

public function supprimerNote($id,$back)
	{
		//
		$note = Note::findOrFail($id);
		$note->update(['etat'=>0]);
		$id=$note->contact_id;

	
		if ($back==0) {
			# code...
			return  redirect(route('contact.show',$id));
		} else {
			# code...
			return  redirect(route('notes.index'));
		}
		

	}


/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */

/*  gestion du filtre par catégorie*/
	public function FiltreCategorie($cat)
	{
		
			$actif ='notes';
		//
		if ($cat == 'afaire') {

			$note_past= Note::where('etat','1')->where('categorie','A faire')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_futur= Note::where('etat','1')->where('categorie','A faire')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_auj= Note::where('etat','1')->where('categorie','A faire')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		
		}

		elseif ($cat == 'tel') {

			$note_past= Note::where('etat','1')->where('categorie','Appel téléphonique')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_futur= Note::where('etat','1')->where('categorie','Appel téléphonique')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_auj= Note::where('etat','1')->where('categorie','Appel téléphonique')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		
		}

		elseif ($cat == 'email') {
			
			$note_past= Note::where('etat','1')->where('categorie','E-mail')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_futur= Note::where('etat','1')->where('categorie','E-mail')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_auj= Note::where('etat','1')->where('categorie','E-mail')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		
		}

		elseif ($cat == 'reunion') {

			$note_past= Note::where('etat','1')->where('categorie','Réunion')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_futur= Note::where('etat','1')->where('categorie','Réunion')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_auj= Note::where('etat','1')->where('categorie','Réunion')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		
		}

		elseif ($cat == 'autre') {

			$note_past= Note::where('etat','1')->where('categorie','Autre')->where('echeance','<',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_futur= Note::where('etat','1')->where('categorie','Autre')->where('echeance','>',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
			$note_auj= Note::where('etat','1')->where('categorie','Autre')->where('echeance','=',Carbon::today())->orderBy('updated_at', 'desc')->paginate(15);
		
		}
		
		return view('notes.index',compact('note_auj','note_futur','note_past','note_auj','actif'));

	}



}
