<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Devis;
use App\Livraison;
use App\Produit;
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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		//

		$profil = Livraison::findOrfail($request->input('id'));
		
		foreach ($profil->modules as $key => $value) {
			$produit_id = $value->pivot->produit_id;
		}
		$produit = Produit::findOrFail($produit_id);
		$produits = $produit->modules;

		// var_dump($profil);
		// var_dump($produits);

		$cle = $request->input('cle');
		$mac = $request->input('mac');

		$dv_prefix = $produit->prefix_produit;
		$dv_suffix = $produit->suffix_produit;

		$livraison_number = DB::table('livraisons')->select('num_bl')->where('num_bl','like','%BL-'.$dv_prefix.'%')->orderBy('id', 'desc')->first();
			if(empty($livraison_number)){
				$num_bl = 'BL-'.$dv_prefix.'-'.date('y').date('m').$dv_suffix;
			}else{
				foreach ($livraison_number as $blvalue) {
						$last_bl_number = $blvalue;
					}
				$lg = strlen('BL-'.$dv_prefix.'-')+4;
				$inc_lv_number = substr($last_bl_number,$lg)+1;
				$num_bl = 'BL-'.$dv_prefix.'-'.date('y').date('m').$inc_lv_number;
			}

		$societedata = DB::table('societedatas')->select('id')->orderBy('created_at', 'desc')->first();

		$data = ['num_bl'=>$num_bl,'devis_id'=>$profil->id,'num_cle'=>$cle,'num_mac'=>$mac,
					'suivi_bl'=>$profil->suivi_devis,'destinataire'=>$profil->nom_scliente,'adresse_dest'=>$profil->adresse_scliente,
					'pays_dest'=>$profil->pays_clt,'ville_dest'=>$profil->ville_clt,'tel_dest'=>$profil->tel_clt,'ref_dest'=>$profil->ref_client,
					'num_cmd'=>$profil->num_devis,'livraison_modal'=>$num_bl,'contact_dest'=>$profil->nom_scontact,'societedata_id'=>$societedata->id,'fax_dest'=>$profil->fax_clt,
					'email_dest'=>$profil->email_clt,'url_dest'=>$profil->url_clt,'nom_produit'=>$profil->produit];
		
		$livraison = Livraison::create($data);

		$modules = $profil->modules;

		foreach ($modules as $value) {
			$livraison->modules()->attach($value->pivot->module_id,
					['quantite'=>$value->pivot->produit_quantite,'produit_id'=>$value->pivot->produit_id]);
		}
		$id = $livraison->id;
		
		return redirect()->route('livraison.show',$id);
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
