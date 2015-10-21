<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateDevisRequest;
use App\Http\Controllers\Controller;
Use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Societe;
use App\Contact;
use App\Produit;
use App\Module;
use App\Devis;
use App\User;
use App\Ligne;
use App\Societedata;
use App\Gescom;
use DB;

class DevisController extends Controller {


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

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$actif = 'gescom';
		$societe = Societe::lists('nom_clt','id','adresse_siege_clt','ville_siege_clt','pays_clt');
		$profil = Gescom::first();
		return view('gescom.creer-devis',compact('actif','societe','gescom'));
	}
	public function creerdevis()
	{
		//
		$actif = 'gescom';
		$societes[''] = '';
		$societes[0] = 'Tous les contacts';
		$contacts[''] = '';
		$modules[''] = '';

		$gescom = Gescom::first();
		$societe = Societe::select('id','nom_clt')->where('etat',1)->get();
		$contact = Contact::select('id','nom_contact','prenoms_contact')->where('etat',1)->get();
		$module = Module::where('etat_module',1)->orderBy('nom_module','asc')->get();
		$produits = Produit::where('etat_produit',1)->get();

		// Remplissage du tableau des modules
		foreach ($produits as $value) {
			$modules[$value->id] = 'Licence '.$value->nom_produit.' Version '.$value->vers_produit;
		}

		foreach ($module as $key => $value) {
			foreach ($value->produits as $pkey => $pvalue) {
				if($value->type_module != 'Base'){
					$modules[$value->id.'.'.$pvalue->id] = $value->nom_module.' ('.$pvalue->nom_produit.')';
				}	
			}
			
		}
		
		// Remplissage du tableau des sociétés
		foreach ($societe as $key => $value) {
			$societes[$value->id] = $value->nom_clt;
		}

		// Remplissage du tableau des contacts 
		foreach ($contact as $key => $value) {
			$contacts[$value->id] = $value->nom_contact.' '.$value->prenoms_contact;
		}
		
		return view('gescom.creer-devis',compact('actif','societes','contacts','modules','gescom'));
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateDevisRequest $request)
	{
		/** Début function extraction partie string **/
		function strafter($string, $substring) {
		  $pos = strpos($string, $substring);
		  if ($pos === false)
		   return $string;
		  else 
		   return(substr($string, $pos+strlen($substring)));
		}
		function strbefore($string, $substring) {
		  $pos = strpos($string, $substring);
		  if ($pos === false)
		   return $string;
		  else 
		   return(substr($string, 0, $pos));
		}
		/** Fin function extraction partie string **/

		$data = $request->all();
		
		$modules = $request->input('module_id');

		
		
		foreach ($modules as $key => $value) {
			if (strpos($value,'.') === false) {
			  $produit = Produit::findOrFail($value);
			  
			  $modules_produit = $produit->modules;
			  if($data['produit_quantite'][$key] != 0){
			  	foreach ($modules_produit as $module) {
			  		if($module->type_module=='Base'){
			  			$data['module_id'][]= $module->id.'.'.$value;
			  			$data['produit_quantite'][] = $data['produit_quantite'][$key];
			  			$data['produit_remise'][] = $data['produit_remise'][$key];
			  			$data['service_duree'][] = $data['service_duree'][$key];
			  		}
			  	}

			  }
			}
			
		}
		
		

		$modules = $data['module_id'];
		


		foreach ($modules as $key => $value) {
		  if(!empty($value)){
		  	if (strpos($value,'.') !== false) {
				$produit = Produit::findOrfail(strafter($value,'.'));
				$dv_prefix = $produit->prefix_produit;
				$dv_suffix = $produit->suffix_produit;
				$devis_number = DB::table('devis')->select('num_devis')->where('num_devis','like','%DV-'.$dv_prefix.'%')->orderBy('id', 'desc')->first();
				if(empty($devis_number)){
					$dv_num = 'DV-'.$dv_prefix.'-'.date('y').date('m').$dv_suffix;
				}else{
					foreach ($devis_number as $dnvalue) {
							$last_dv_number = $dnvalue;
						}
					$lg = strlen('DV-'.$dv_prefix.'-')+4;
					$inc_devis_number = substr($last_dv_number,$lg)+1;
					$dv_num = 'DV-'.$dv_prefix.'-'.date('y').date('m').$inc_devis_number;
				}
				
				$module_id = strbefore($value,'.');
				$produit_id = strafter($value,'.');

				$produit_quantite = $data['produit_quantite'][$key];
				$produit_remise = $data['produit_remise'][$key];
				$service_duree = $data['service_duree'][$key];
					
				$ligne [$key] = ['module_id'=>$module_id,'produit_id'=>$produit_id,'service_duree'=>$service_duree,
									'devis_id'=>$dv_num,'produit_quantite'=>$produit_quantite,'produit_remise'=>$produit_remise];
				
				$devi_module [$key] = ['module_id'=>$module_id,'produit_id'=>$produit_id,
									'devis_id'=>$dv_num,'produit_quantite'=>$produit_quantite,'produit_remise'=>$produit_remise];
				}
			}
		}

 
			$dv_number_liste = [];
			foreach ($ligne as $key => $value) {
				foreach ($value as $lkey => $lvalue) {
					if(substr($lvalue,0,2)=='DV'){
						if(empty($dv_number_liste)){
							$produit = Produit::select('nom_produit','vers_produit')->findOrfail($value['produit_id']);
							$nom_produit = $produit->nom_produit.' '.$produit->vers_produit;
							$dv_number_liste[$nom_produit] = $lvalue;
						}else{
							$exist = 0;
							foreach ($dv_number_liste as $dkey => $dvalue) {
									if($dvalue == $lvalue){
										$exist = 1;
									}
								}
								if($exist==0){
									$produit = Produit::select('nom_produit','vers_produit')->findOrfail($value['produit_id']);
									$nom_produit = $produit->nom_produit.' '.$produit->vers_produit;
									$dv_number_liste[$nom_produit] = $lvalue;
								}
							}
						}
					
				}
			}
			
			// Récupération des données à entrer dans la table Devis
			setlocale(LC_TIME, 'fr');
			$sclient = Societe::findOrfail($data['societe_id']);
			$client = Contact::select('nom_contact','prenoms_contact','genre_contact')->findOrfail($data['contact_id']);
			$nom_client = $client->nom_contact.' '.$client->prenoms_contact;
			$societedata = DB::table('societedatas')->select('id')->orderBy('created_at', 'desc')->first();
			$gescom = DB::table('gescoms')->select('id')->orderBy('created_at', 'desc')->first();
		
			$restemois = Carbon::now()->daysInMonth - Carbon::now()->day;
			$add = $restemois + 30;
			$echeance = Carbon::now()->addDays($add)->formatLocalized('%d %B %Y');

			// Remplissage des lignes d'entrées dans la table de devis
			foreach ($dv_number_liste as $key => $value) {
					$dv_num_int = $data['prefix_id'].'/'.$value;
					$lg2 = strlen('DV-'.$dv_prefix.'-');
					$dv_num_ext = substr($value,$lg2);


					
					
					$devis  = ['num_devis'=>$value,'num_devis_int'=>$dv_num_int,'num_devis_ext'=>$dv_num_ext,
								'pays_clt'=>$sclient->pays_clt,'ville_clt'=>$sclient->ville_siege_clt,'produit'=>$key,
								'adresse_scliente'=>$sclient->adresse_siege_clt,'tel_clt'=>$sclient->tel_siege_clt,
								'fax_clt'=>$sclient->fax_siege_clt,'bp_clt'=>$sclient->bp_clt,'email_clt'=>$sclient->email_siege_clt,
								'nom_scontact'=>$nom_client,'nom_scliente'=>$sclient->nom_clt,'url_clt'=>$sclient->url_clt,
								'ref_client'=>$sclient->ref_client,'civilite_contact'=>$client->genre_contact,'echeance_devis'=>$echeance,
								'user_id'=>$data['user_id'],'suivi_devis'=>$data['suivi_devis'],'societedata_id'=>$societedata->id,
								'gescom_id'=>$gescom->id,'contact_id'=>$data['contact_id'],'societe_id'=>$data['societe_id']];

					Devis::create($devis);
				}	
				
				
				
			// Enregistrement direct des données dans la table ligne_devis
				$produit_base = $ligne;
			
				foreach ($ligne as $key => $value) {
					$devis_id = Devis::select('id')->where('num_devis',$value['devis_id'])->get();
					foreach ($devis_id as $dvkey => $dvvalue) {
						$value['devis_id'] = $dvvalue->id;
					}

					//$produit_base[$] = $value['produit_id'];
					/*** Utilisation de la fonction Many To Many **/
						$devis_module = Devis::findOrfail($value['devis_id']);

						$id_devis[$value['produit_id']] = $devis_module->id;
					
				$devis_module->modules()->attach($value['module_id'],['produit_quantite'=>$value['produit_quantite'],
				'produit_remise'=>$value['produit_remise'],'produit_id'=>$value['produit_id'],'service_duree'=>$value['service_duree']]);

				
					
				}


				// Enregistrement des modules de base pour les licences présentes 
				foreach ($id_devis as $key => $value) {
					
					$produits_list = Produit::findOrfail($key);
					$module_list = $produits_list->modules;
					foreach ($module_list as $mkey => $mvalue) {
						if($mvalue->type_module=='Base'){
							$modules_base [$key][] = $mvalue->id;
						}
					}
				}
				
				

			
				// Calcul des totaux des devis 
				foreach ($ligne as $key => $value) {
					$devis_id = Devis::select('id')->where('num_devis',$value['devis_id'])->get();
					foreach ($devis_id as $dvkey => $dvvalue) {
						$value['devis_id'] = $dvvalue->id;
					}
					$tht = 0 ;
					$devis = Devis::with('gescom')->findOrfail($value['devis_id']);
					foreach ($devis->modules as $modules) {
						$tt = $modules->pivot->produit_quantite * $modules->prix_module;
						$remise = $tt *($modules->pivot->produit_remise/100);
						$tht += $tt - $remise;
					}
					$remise_anpme = $tht * ($devis->gescom->taux_anpme/100);
					$tt_anpme = $tht * ($devis->gescom->taux_anpme/100);
					$tt_part = $tht  - $tt_anpme;
					$devis_update = ['total_ht'=>$tht,'total_anpme'=>$tt_anpme,'total_part'=>$tt_part];
					
					$devis->update($devis_update);
				}

			return redirect()->route('gescom.index');
			 
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
		$profil = Devis::with('gescom','societedata')->findOrfail($id);
		
		foreach ($profil->modules as $key => $value) {
			$produit_id = $value->pivot->produit_id;
		}
		$produit = Produit::findOrFail($produit_id);
		$produits = $produit->modules;
		$actif = 'gescom';
		
		return view('gescom.detail-devis', compact('actif','profil','produits'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editer($id)
	{
		//
		$actif = 'gescom';
		$societes[''] = '';
		$societes[0] = 'Tous les contacts';
		$contacts[''] = '';
		

		$gescom = Gescom::first();
		$societe = Societe::select('id','nom_clt')->where('etat',1)->get();
		$contact = Contact::select('id','nom_contact','prenoms_contact')->where('etat',1)->get();

		$modules[''] = '';
		$module = Module::where('etat_module',1)->orderBy('nom_module','asc')->get();
				
				// Remplissage du tableau des modules
				foreach ($module as $key => $value) {
					foreach ($value->produits as $pkey => $pvalue) {
						$modules[$value->id.'.'.$pvalue->id] = $value->nom_module.' ('.$pvalue->nom_produit.')';
					}
					
				}
		
		
		// Remplissage du tableau des sociétés
		foreach ($societe as $key => $value) {
			$societes[$value->id] = $value->nom_clt;
		}

		// Remplissage du tableau des contacts 
		foreach ($contact as $key => $value) {
			$contacts[$value->id] = $value->nom_contact.' '.$value->prenoms_contact;
		}

		$profil = Devis::with('gescom','societedata')->findOrfail($id);
		
		foreach ($profil->modules as $key => $value) {
			$produit_id = $value->pivot->produit_id;
		}

		$produit = Produit::findOrFail($produit_id);
		$produits = $produit->modules;
		$actif = 'gescom';
		
		return view('gescom.edit-devis', compact('actif','profil','produits','contacts','gescom','societes','modules'));
		
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
		
		$devis = Devis::findOrFail($id);
		$devis->update(['etat_devis'=>0]);
		return  redirect(route('gescom.index'));
	}

}
