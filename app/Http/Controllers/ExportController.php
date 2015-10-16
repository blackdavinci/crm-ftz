<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Societe;
use Excel;
use Input;
use DB;
use Illuminate\Http\Request;

class ExportController extends Controller {

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
		return view('contact.export-contact',compact('actif'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
		Excel::create('ExportAllContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$data = Societe::all();
					$i = 1;
					foreach($data as $data){
						$extract[$i] = [
							'Nom de la société'=>$data->nom_clt,
							'Effectif' => $data->effectif_clt,
							'Chiffre d\'affaire'=> $data->ca_clt,
							'N° TVA'=> $data->num_tva_clt,
							'URL'=> $data->url_clt,
							'Téléphone'=> $data->tel_siege_clt,
							'Fax'=> $data->fax_siege_clt,
							'E-mail'=> $data->email_siege_clt,
							'Pays'=> $data->pays_clt,
							'Ville'=> $data->ville_siege_clt,
							'Adresse'=> $data->adresse_siege_clt,
							'Commentaire'=> $data->comment_clt
						];
						$i++;
					}
					$sheet->fromArray($extract);
				});

		})->export('xls');
		
		return  redirect(route('export.index'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Export de données sélectionnées 

		$type = $request->input('type_export');

		Excel::create('ExportAllContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$donnees = Input::all();
					$c = 0;
					foreach($donnees as $key=>$value){
						if($key !='type_export' && $key != '_token')
							$select[$c] = $value;
							$c++;
					}
					$data = DB::table('societes')->select($select)->get();

					$i = 1;

					// Modification des noms d'index du tableau data
					foreach($data as $data){
						
						if(isset($data->nom_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Société'=>$data->nom_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Société',$data->pays_clt);
							}
						}
						if(isset($data->effectif_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Effectif'=>$data->effectif_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Effectif',$data->effectif_clt);
							}
							
						}
						if(isset($data->ca_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Chiffre d\'affaire'=>$data->ca_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Chiffre d\'affaire',$data->ca_clt);
							}
							
						}
						if(isset($data->num_tva_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['N°TVA'=>$data->num_tva_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'N°TVA',$data->num_tva_clt);
							}
							
						}
						if(isset($data->url_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['URL'=>$data->url_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'URL',$data->url_clt);
							}
							
						}
						if(isset($data->tel_siege_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Téléphone'=>$data->tel_siege_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Téléphone',$data->tel_siege_clt);
							}
							
						}
						if(isset($data->fax_siege_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Fax'=>$data->fax_siege_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Fax',$data->fax_siege_clt);
							}
							
						}
						if(isset($data->email_siege_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['E-mail'=>$data->email_siege_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'E-mail',$data->email_siege_clt);
							}
							
						}
						if(isset($data->pays_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Pays'=>$data->pays_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Pays',$data->pays_clt);
							}
						}
						if(isset($data->ville_siege_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Ville'=>$data->ville_siege_clt];
							}
							else{
								$extract[$i]= array_add($extract[$i],'Ville',$data->ville_siege_clt);
							}
							
						}
						if(isset($data->adresse_siege_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Adresse'=>$data->adresse_siege_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Adresse',$data->adresse_siege_clt);
							}
							
						}
						if(isset($data->comment_clt)){
							if(!isset($extract[$i])){
							$extract[$i] = ['Commentaire'=>$data->comment_clt];
							}
							else{
								$extract[$i]=array_add($extract[$i],'Commentaire',$data->comment_clt);
							}
							
						}
						$i++;
						
					}		
					$sheet->fromArray($extract);
				});

		})->export($type);

		return  redirect(route('export.index'));

		 
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
