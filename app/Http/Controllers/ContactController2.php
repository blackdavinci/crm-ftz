<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Requests\CreateSocieteRequest;
use App\Http\Requests\CreateContactRequest;
use App\Http\Controllers\Controller;

use App\Societe;
use App\Contact;
use App\Http\Controllers\Pays;

use Illuminate\Http\Request;
use Illuminate\Html\FormFacade;


class ContactController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contact = Contact::with(['societe'=> function($query){ $query->select('nom_clt','id'); }])->where('etat',1)->orderBy('nom_contact','asc')->get();
		$actif = 'contact';
		$type = 1;
		return view('contact.contact', compact('actif','contact','type'));
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
		return view('contact.creer-contact',compact('actif','id'));
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateContactRequest $request)
	{
		$actif ='contact';
		Contact::create($request->all());
		$id = $request->societe_id;
		return  redirect(route('societe.show', $id));
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
		$ListNote = Contact::findOrFail($id)->note()->where('etat',1)->get();
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
		return  redirect(route('societe.show',$id));
	}

	/**
	 * Return Contact Sort to View.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function TriContact($type)
		{
			//

			return 'Tri Contact '.$type.' Thanks';
		}

}
