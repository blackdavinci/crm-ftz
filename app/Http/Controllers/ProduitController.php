<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProduitRequest;

use Illuminate\Http\Request;

use App\Produit;
use App\Module;
use Elasticsearch\Client;
use DB;



class ProduitController extends Controller {

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
		$produit = Produit::where('etat_produit',1)->orderBy('nom_produit','desc')->get();

		return view('gescom.liste-produit',compact('actif','produit'));
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
		return view('gescom.create-produit',compact('actif'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateProduitRequest $request)
	{
		$client = new Client();
		$params = array();
		
		foreach ($request->all() as $key => $value) {
			if($key != 'add_module'){
				$data[$key] = $value;
			}
		}
		
		Produit::create($data);

		$id = DB::table('produits')->select('id')->orderBy('id', 'desc')->first();
		foreach ($id as $value) {
			$id = $value;
		}
	
		// $params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		// $params['index'] = 'ftz';
		// $params['type']  = 'societes';
		// $params['id']    = $id;

		// $indexes = $client->index($params);

		$actif ='gescom';
		if($request->input('add_module')){
			return redirect(route('module.creer',$id));
		}else{
			return redirect(route('produit.show',$id));	
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
		$actif ='gescom';
		$detail = Produit::findOrFail($id);
		$listmodule = Produit::findOrFail($id)->modules()->where('etat_module',1)->get();
		
		return view('gescom.detail-produit',compact('actif','detail','listmodule'));
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
		$detail = Produit::findOrFail($id);
		return view('gescom.edit-produit',compact('actif','detail'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CreateProduitRequest $request)
	{
		//
		//
		$client = new Client();
		$params = array();

		$produit = Produit::findOrFail($id);
		$produit->update($request->all());

		// $params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		// $params['index'] = 'ftz';
		// $params['type']  = 'societes';
		// $params['id']    = $id;

		// $indexes = $client->index($params);

		return  redirect(route('produit.show', $id));
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

		$module = Produit::findOrFail($id)->module()->select('id')->where('etat_module',1)->get();
		
		if(!empty($module->id)){
			foreach ($module as $value) {
			$module = Module::findOrFail($value->id);
			$module->update(['etat_module'=>0]);
			}
			foreach ($module as $value) {
					$module->update(['etat_module'=>0]);
			}
		}
	
		$produit = Produit::findOrFail($id);
		$produit->update(['etat_produit'=>0]);
		return  redirect(route('produit.index'));
	}

}
