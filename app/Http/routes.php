<?php
use App\Societe;
use App\Produit;
use App\Contact;
use App\Module;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/* Agenda Test */


Route::get('/agenda',function(){
		$actif ='agenda';
		return view('agenda.calendrier',compact('actif'));
	});

/* Test Page */

Route::get('/test',function(){
		$actif ='accueil';
		return view('test',compact('actif'));
	});

Route::get('/testappend',['as'=>'testappend',function(Request $request){
		$actif ='accueil';
		return(Request::input('test'));
	}]);

Route::get('/testcreer',function(){
		$actif ='accueil';
		return view('contact.create-societes',compact('actif'));
	});

Route::post('/test',['as'=>'test.store',function(Request $request){
		$actif ='accueil';
		return Request::input('date_groupe');
	}]);

/* Other Test Routes */

Route::get('/CheckSocieteExist',function(){
	if(Request::ajax()){
	
		$societe = Request::get('societe');
		$check = DB::table('societes')->select('nom_clt')->where('nom_clt',$societe)->count();
			
			if($societe==NULL){
				$text == "<h4><span class='label label-info'>Saisissez le nom de l\'entreprise</span></h4>";
			}else{
				if($check==0 ){
				$text = "<h4><span class='label label-success'>Société non existante</span></h4>";

				}
				if($check>0){
						$text = "<h4><span class='label label-danger'>Société déjà existante</span></h4>";
				}
			}
		
		return $text;
	}
});

Route::get('/ProduitSelect',function(){
	if(Request::ajax()){
		
		$id = Request::get('id');
	
		$data_prod = Produit::findOrFail($id);
		$module_prod = Produit::findOrFail($id)->module()->where('etat_module',1)->get();

		$data['data']['dv_suffix'] = 'DV-'.$data_prod->suffix_produit;
		$data['data']['prefix'] = $data_prod->prefix_produit;
		$data['data']['num'] = date('y').date('m').$data_prod->prefix_produit;
		$data['data']['dv_num'] = 'DV-'.$data_prod->suffix_produit.'-'.date('y').date('m').$data_prod->prefix_produit;	

	}


		foreach ($module_prod as $key => $value) {
			$data['module'][$value->id] = $value->nom_module;
		}
	return json_encode($data);
});

Route::get('/ModuleSelect',function(){
	if(Request::ajax()){
		
		$id = Request::get('id');
	
		$module_prod = Produit::findOrFail($id)->module()->where('etat_module',1)->get();	
		foreach ($module_prod as $key => $value) {
			$data[$value->id] = $value->nom_module;
		}
		

	}
	return json_encode($data);
});


/**** Ajax for EDIT page ***/

Route::get('{id}/SocieteSelect',function(){
	if(Request::ajax()){
	
		$id = Request::get('id');
		
		if($id==0){
			$contacts = Contact::select('id','nom_contact','prenoms_contact')->where('etat',1)->get();
		}else{
			$contacts = Societe::findOrFail($id)->contacts()->where('etat',1)->get();
		}
		

		if($contacts->isEmpty()){
			$data = [];
		}else{
			foreach ($contacts as $key => $value) {
				$data[$value->id] = $value->nom_contact.' '.$value->prenoms_contact;
			}
		}
		
	}
	return json_encode($data);
});

Route::get('{id}/ContactSelect',function(){
	if(Request::ajax()){
	
		$id = Request::get('id');
	
		$adresse = DB::table('contacts')->select('societe_id')->where('id',$id)->get();
		foreach ($adresse as $key => $value) {
			$data['societe_id'] = $value->societe_id;
		}

	}
	return json_encode($data);
});

Route::get('{id}/ArticleSelect',function(){
	if(Request::ajax()){

	function strbefore($string, $substring) {
	  $pos = strpos($string, $substring);
	  if ($pos === false)
	   return $string;
	  else 
	   return(substr($string, 0, $pos));
	}

	function strafter($string, $substring) {
	  $pos = strpos($string, $substring);
	  if ($pos === false)
	   return $string;
	  else 
	   return(substr($string, $pos+strlen($substring)));
	}

		$id = strbefore(Request::get('id'),'.');
		$id_produit = strafter(Request::get('id'),'.');
			
		$module = Module::select('prix_module')->findOrFail($id);
		$produit = Produit::select('nom_produit','vers_produit')->findOrFail($id_produit);
		$data['module']['prix_module'] = $module->prix_module;
		$data['produit']['id'] = $id_produit;
		$data['produit']['nom'] = 'Licence '.$produit->nom_produit.' Version '.$produit->vers_produit;
			
	}
	return json_encode($data);
});

/**** Ajax for others pages ***/


Route::get('/SocieteSelect',function(){
	if(Request::ajax()){
	
		$id = Request::get('id');
		
		if($id==0){
			$contacts = Contact::select('id','nom_contact','prenoms_contact')->where('etat',1)->get();
		}else{
			$contacts = Societe::findOrFail($id)->contacts()->where('etat',1)->get();
		}
		

		if($contacts->isEmpty()){
			$data = [];
		}else{
			foreach ($contacts as $key => $value) {
				$data[$value->id] = $value->nom_contact.' '.$value->prenoms_contact;
			}
		}
		
	}
	return json_encode($data);
});

Route::get('/ContactSelect',function(){
	if(Request::ajax()){
	
		$id = Request::get('id');
	
		$adresse = DB::table('contacts')->select('societe_id')->where('id',$id)->get();
		foreach ($adresse as $key => $value) {
			$data['societe_id'] = $value->societe_id;
		}

	}
	return json_encode($data);
});

Route::get('/NotesSelect',function(){
	if(Request::ajax()){
	
		$time = date("Y-m-d", Request::get('time'));
		
		$notes = DB::table('notes')->select('id','nom','categorie','designation')->where('echeance',$time)->get();
		foreach ($notes as $note) {
			$data['id'][] = $note->id;
			$data['nom'][] = $note->nom;
			$data['categorie'][] = $note->categorie;
			$data['designation'][] = substr($note->designation,0,60).'......';
		}

	}
	return json_encode($data);
});




Route::get('/ArticleSelect',function(){
	if(Request::ajax()){

	function strbefore($string, $substring) {
	  $pos = strpos($string, $substring);
	  if ($pos === false)
	   return $string;
	  else 
	   return(substr($string, 0, $pos));
	}

	function strafter($string, $substring) {
	  $pos = strpos($string, $substring);
	  if ($pos === false)
	   return $string;
	  else 
	   return(substr($string, $pos+strlen($substring)));
	}

		$id = strbefore(Request::get('id'),'.');
		$id_produit = strafter(Request::get('id'),'.');
			
		$module = Module::select('prix_module','type_module')->findOrFail($id);
		$produit = Produit::select('nom_produit','vers_produit')->findOrFail($id_produit);
		$data['module']['prix_module'] = $module->prix_module;
		$data['module']['type_module'] = $module->type_module;
		$data['produit']['id'] = $id_produit;
		$data['produit']['nom'] = 'Licence '.$produit->nom_produit.' Version '.$produit->vers_produit;
			
	}
	return json_encode($data);
});


Route::get('/ProduitArticleSelect',function(){
	if(Request::ajax()){

		$id = Request::get('id');
		
		$produit = Produit::findOrFail($id);
		$modules = $produit->modules;
		foreach ($modules as $value) {
			if($value->type_module=='Base'){
				$data [] = $value->id.'.'.$id;
			}
		}

	}
	return json_encode($data);
});

/* Home View Route */

Route::get('/','WelcomeController@index');

/* Societe & Contact Views Routes */

Route::get('creer-societe',['as'=>'creer.societe', 'uses'=>'SocieteController@creersociete']);

Route::get('getRequest','SocieteController@GetRequestSocieteExist');

Route::post('societe/action',['as'=>'societe.action','uses'=>'ActionController@DeleteChecked']);

Route::get('societe/Tri/{tripar}',['as'=>'societe.TriSociete', 'uses'=>'SocieteController@TriSociete']);

Route::get('groupe/Tri/{tripar}/{id}',['as'=>'groupe.Trigroupe', 'uses'=>'GroupeController@Trigroupe']);

Route::get('contact/Tri/{tripar}',['as'=>'contact.TriContact', 'uses'=>'ContactController@TriContact']);

Route::get('societe/suppression/{data}',['as'=>'societe.destroyselect','uses'=>'SocieteController@destroyselect']);

Route::get('annuaire/search',['as'=>'annuaire.search','uses'=>'SearchController@searchableannuaire']);

Route::get('grille','SocieteController@grille');

Route::get('liste','SocieteController@liste');

Route::resource('groupe', 'GroupeController');

Route::resource('societe', 'SocieteController');

Route::resource('contact', 'ContactController');

Route::get('{id}/creer-contact',['as'=> 'creer.contact', 'uses'=> 'ContactController@creercontact']);

Route::post('/checksociety','SocieteController@checksociety');



/* Import & Export Views Routes */

Route::get('import/google',['as'=>'import.google','uses'=>'ImportController@ImportGoogleContact']);

Route::resource('import','ImportController');

Route::resource('export','ExportController');




/* Note Views Routes */

Route::get('notes/categorie/{cat}',['as'=>'notes.categorie','uses'=>'NotesController@FiltreCategorie']);

Route::get('{id}/creer-note',['as'=> 'creer.note', 'uses'=> 'NotesController@creerNote']);

Route::get('{id}/afficher-note/{back}',['as'=> 'afficher.note', 'uses'=> 'NotesController@aficherNote']);

Route::get('{id}/modifier-note/{back}',['as'=> 'modifier.note', 'uses'=> 'NotesController@modifierNote']);

Route::get('{id}/list-notes/{back}',['as'=> 'liste.note', 'uses'=> 'NotesController@noteContact']);

Route::get('{id}/notes-societe/{back}',['as'=> 'societe.note', 'uses'=> 'NotesController@noteSociete']);

Route::put('{id}/changer-note/{back}',['as'=> 'changer.note', 'uses'=> 'NotesController@changerNote']);

Route::delete('{id}/supprimer-note/{back}',['as'=> 'supprimer.note', 'uses'=> 'NotesController@supprimerNote']);


Route::resource('notes','NotesController');

/* Agenda Views Routes */

Route::get('calendrier',['as'=>'agenda.calendrier', 'uses'=>'AgendaController@showagenda']);

Route::get('calendrier-perso',['as'=>'agenda.calendrier-perso', 'uses'=>'AgendaController@showagendaperso']);

Route::resource('agenda','AgendaController');

/* Gescom Views Routes */

Route::get('{id}/creer-module',['as'=>'module.creer', 'uses'=>'ModuleController@creer']);

Route::get('creer-devis',['as'=>'devis.creer', 'uses'=>'DevisController@creerdevis']);

Route::get('{id}/editer',['as'=>'devis.editer', 'uses'=>'DevisController@editer']);

Route::post('module/action',['as'=>'module.action','uses'=>'ActionController@DeleteChecked']);

Route::resource('gescom','GescomController');

Route::resource('devis','DevisController');

Route::resource('ligne','LigneDevisController');

Route::resource('livraison','LivraisonController');

Route::resource('commande','CommandeController');

Route::resource('facture','FactureController');

Route::resource('produit','ProduitController');

Route::resource('module','ModuleController');

/* Rapport Views Routes */

Route::post('dashbord',['as'=> 'evenement.rapport', 'uses'=> 'RapportController@evenement']);


Route::resource('rapport','RapportController');

/* Login View Route & Home Route*/

Route::get('home', 'HomeController@index');

/* Users & Parameters Route */

Route::get('{id}/setpassword',['as'=>'users.setpassword','uses'=>'UsersController@SetPassword']);

Route::put('{id}/updatepassword',['as'=>'users.updatepassword','uses'=>'UsersController@updatepassword']);

Route::get('{id}/desactived',['as'=>'users.desactived','uses'=>'UsersController@desactived']);


Route::resource('societedata','SocieteDataController');

Route::resource('preference','PreferenceController');

Route::resource('gescomconfig','ConfiggescomController');

Route::resource('users','UsersController');

Route::resource('parametres','ParametresController');


/* Authentification Routes */

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);




















