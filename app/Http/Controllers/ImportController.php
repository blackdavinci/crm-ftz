<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Societe;
use Excel;
use Input;
use DB;
// use Request;

use Illuminate\Http\Request;

class ImportController extends Controller {


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
		$actif = 'contact';
		return view('contact.import-contact',compact('actif'));
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
	public function store(Request $request)
	{
		//
		$i = 0;
		$j = 0;
		$import_one [0]= '';
		$import [0] = '';
		$societe = Societe::get();

		$path = $_FILES['contact']['tmp_name'];
  
		$results = Excel::load($path)->get();
		
		foreach($results as $value){
				if(!empty($value->societe)){
					$import_merge[$i] = $value;
				}	
				$i++;
		}
	// Contrôles de doublons dans le fichier Importer
		foreach ($import_merge as $key => $value) {
			$exist = 0;
			foreach ($import_one as $ikey => $ivalue) {
				if($value == $ivalue){
					$exist = 1;
				}
			}
			if($exist==0){
				$import_one[$key] = $value;
			}

			$i++;
		}
		// Contrôle de de l'existance dans la base de données
		foreach ($import_one as $key => $value) {
			$exist = 0;
			foreach ($societe as $skey => $svalue) {
				if($value->societe == $svalue->nom_clt){
					$exist = 1;
				}
			}

			if($exist==0){
				$import[$key] = $value;
			}

			$i++;
		}

	
		if($import[0]!=''){
			foreach($import as $value){
			Societe::create([
				'nom_clt'=>$value->societe,
				'effectif_clt'=>$value->effectif,
				'ca_clt'=>$value->chiffre_daffaire,
				'comment_clt'=>$value->commentaire,
				'num_tva_clt'=>$value->n_tva,
				'url_clt'=>$value->url,
				'tel_siege_clt'=>$value->telephone,
				'fax_siege_clt'=>$value->fax,
				'email_siege_clt'=>$value->e_mail,
				'ville_siege_clt'=>$value->ville,
				'pays_clt'=>ucfirst(strtolower($value->pays)),
				'adresse_siege_clt'=>$value->adresse,
				]);
			}
		}
		
		return redirect('import');
	}

		
	/**
	 * Import a Google Contact .
	 *
	 * @return Response
	 */
	public function ImportGoogleContact(Request $request)
	{
		// get data from request
		   $code = $request->get('code');

		   // get google service
		   $googleService = \OAuth::consumer('Google');

		   // check if code is valid

		   // if code is provided get user data and sign in
		   if ( ! is_null($code)) {
		       // This was a callback request from google, get the token
		       $token = $googleService->requestAccessToken($code);

		       // Send a request with it
		       $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=400'), true);

		       // Going through the array to clear it and create a new clean array with only the email addresses
		       $emails = []; // initialize the new array
		       foreach ($result['feed']['entry'] as $contact) {
		           if (isset($contact['gd$email'])) { // Sometimes, a contact doesn't have email address
		               $emails[] = $contact['gd$email'][0]['address'];
		           }
		       }
		       
		       return $emails;

		   }
		   
		   // if not ask for permission first
		   else {
		       // get googleService authorization
		       $url = $googleService->getAuthorizationUri();

		       // return to google login url
		       return redirect((string)$url);
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
