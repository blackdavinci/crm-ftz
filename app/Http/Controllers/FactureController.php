<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Devis;
use App\Livraison;
use App\Produit;
use App\Facture;
use DB;

class FactureController extends Controller {

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
		return view('gescom.create-facture',compact('actif'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$profil = Livraison::with('devis')->findOrfail($request->input('id'));
		
		foreach ($profil->modules as $key => $value) {
			$produit_id = $value->pivot->produit_id;
		}
		$produit = Produit::findOrFail($produit_id);
		$produits = $produit->modules;
		$modules = $profil->modules;

		$da = $request->input('da');
		

		$dv_prefix = $produit->prefix_produit;
		$dv_suffix = $produit->suffix_produit;

		$facture_number = DB::table('factures')->select('num_facture')->where('num_facture','like','%FACT-'.$dv_prefix.'%')->orderBy('id', 'desc')->first();
			var_dump($facture_number);
			if(empty($facture_number)){
				$num_facture = 'FACT-'.$dv_prefix.'-'.date('y').date('m').$dv_suffix;
				
			}else{
				
				foreach ($facture_number as $fctvalue) {
						$last_fct_number = $fctvalue;
					}
				$lg = strlen('FACT-'.$dv_prefix.'-')+4;
				$inc_fct_number = substr($last_fct_number,$lg)+1;
				$num_facture = 'FACT-'.$dv_prefix.'-'.date('y').date('m').$inc_fct_number;
			}
			
		$societedata = DB::table('societedatas')->select('id')->orderBy('created_at', 'desc')->first();

		$data = ['num_facture'=>$num_facture,'devis_id'=>$profil->id,'num_da'=>$da,'livraison_id'=>$profil->id,
					'suivi_facture'=>$profil->suivi_bl,'destinataire'=>$profil->destinataire,'adresse_dest'=>$profil->adresse_dest,
					'pays_dest'=>$profil->pays_dest,'ville_dest'=>$profil->ville_dest,'tel_dest'=>$profil->tel_dest,'ref_dest'=>$profil->ref_dest,
					'num_cmd'=>$profil->num_cmd,'livraison_modal'=>$num_facture,'contact_dest'=>$profil->contact_dest,'societedata_id'=>$societedata->id,'fax_dest'=>$profil->fax_dest,
					'email_dest'=>$profil->email_dest,'url_dest'=>$profil->url_dest,'nom_produit'=>$profil->nom_produit,'echeance'=>$profil->echeance,
					'total_ht'=>$profil->total_ht,'total_anpme'=>$profil->total_anpme,'total_part'=>$profil->total_part,'gescom_id'=>$profil->gescom_id,
					'contact_id'=>$profil->contact_id,'societe_id'=>$profil->societe_id];
		
		$facture = Facture::create($data);

		$modules = $profil->modules;

		foreach ($modules as $value) {
			$facture->modules()->attach($value->pivot->module_id,
					['quantite'=>$value->pivot->quantite,'produit_id'=>$value->pivot->produit_id,
					'service_duree'=>$value->pivot->service_duree]);
		}
		$id = $facture->id;
		
		return redirect()->route('facture.show',$id);
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
		$actif = 'gescom';
		$profil = Facture::with('societedata','livraison','gescom')->findOrfail($id);
		
		foreach ($profil->modules as $key => $value) {
			$produit_id = $value->pivot->produit_id;
		}
		$produit = Produit::findOrFail($produit_id);
		$modules = $profil->modules;

		
		return view('gescom.detail-facture', compact('actif','profil','modules'));
		
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
