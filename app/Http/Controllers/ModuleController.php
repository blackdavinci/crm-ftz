<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateModuleRequest;

use Illuminate\Http\Request;
use App\Produit;
use App\Module;
use Elasticsearch\Client;
use DB;


class ModuleController extends Controller {

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
		$actif = 'gescom';
		$tri = "alpha";
		$module = Module::where('etat_module',1)->orderBy('nom_module','asc')->get();
		
		return view('gescom.liste-module',compact('actif','module','tri'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$actif='gescom';
		$produit = [];
		$produit['null'] = 'Choisissez le produit auquel appartient le module';
		$produits = Produit::lists('nom_produit','id');
		$listproduit = DB::table('produits')->select('id','nom_produit','vers_produit')->get();
		foreach ($listproduit as $key => $value) {
			$produit[$value->id] = $value->nom_produit.' '.$value->vers_produit;
		}
	
		return view('gescom.create-module',compact('actif','produits','produit'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function creer($id)
	{
		//
		$actif = 'gescom';
		$produit = Produit::select('nom_produit')->findOrFail($id);

		return view('gescom.create-module',compact('actif','id','produit'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateModuleRequest $request)
	{


		$actif ='gescom';
		foreach ($request->all() as $key => $value) {
			if($key != 'add_again' && $key !='produit_id_l'){
				$data[$key] = $value;
			}

		}	
		$data = $request->except(['produit_id','add_again','produit_id_l']);		

		$modules = Module::create($data);

		$modules->produits()->sync($request->input('produit_id'));
	

		$id = DB::table('modules')->select('id')->orderBy('id', 'desc')->first();
			foreach ($id as $value) {
				$id = $value;
			}

		if($request->produit_id_l){
			if($request->add_again){
				return redirect(route('module.create'));
			}else{
				return  redirect(route('module.show',$id));
			}
		}else{

			if($request->add_again){
				$id_produit = $request->produit_id;
				return redirect(route('module.creer',$id_produit));
			}else{
				return  redirect(route('module.show',$id));
			}
			
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
		$actif = 'gescom';
		$detail = Module::findOrFail($id);
		return view('gescom.detail-module',compact('actif','detail'));
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

		$actif = 'gescom';
		$detail = Module::findOrFail($id);
		$produits = Produit::lists('nom_produit','id');
		$produits_list = $detail->produits->lists('id')->toArray();

		return view('gescom.edit-module',compact('actif','detail','produits','produits_list'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateModuleRequest $request)
	{
		//
		$module = Module::findOrFail($id);
		$data = $request->except(['produit_id']);
		$module->update($data);
		$module->produits()->sync($request->input('produit_id')); 
	
		return  redirect(route('module.show', $id));
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
		$module = Module::findOrFail($id);
		$module->update(['etat_module'=>0]);
		$id = $module->produit_id;
		return  redirect(route('module.index'));
	}

}
