<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Elasticsearch\Client;
use App\Societe;
use App\Contact;
use App\Groupe;
use SearchIndex;
use DB;
use Excel;
use Input;

use Illuminate\Http\Request;

class ActionController extends Controller {

	/* Authentification function */
	
	public function __construct()
	{
	    $this->middleware('auth');
	}

	//Suppression des éléments sélectionnés 
	public function DeleteChecked(Request $request){
		$i = 1;
		$data = $request->all();
		if($request->input('supp')){
			if($data['type']==0 || $data['type']==3){
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Societe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}elseif($data['type']==1){

				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Contact::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}
				
			}elseif($data['type']==2){
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Groupe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}

		}

		// Import de contacts
		if($request->input('export')){
			Excel::create('ExportContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$donnees = Input::all();
					$j = 0;
					if($donnees['type']==0 || $donnees['type']==3){
						foreach ($donnees as $key => $value) {
							if(substr($key,0,1) == 'c'){
								$profil = Societe::findOrFail($value);
								$export[$key]= $profil;
							}
						}
						
						foreach($export as $donnees){
							$extract[$j] = [
								'Nom de la société'=>$donnees->nom_clt,
								'Effectif' => $donnees->effectif_clt,
								'Chiffre d\'affaire'=> $donnees->ca_clt,
								'N° TVA'=> $donnees->num_tva_clt,
								'URL'=> $donnees->url_clt,
								'Téléphone'=> $donnees->tel_siege_clt,
								'Fax'=> $donnees->fax_siege_clt,
								'E-mail'=> $donnees->email_siege_clt,
								'Pays'=> $donnees->pays_clt,
								'Ville'=> $donnees->ville_siege_clt,
								'Adresse'=> $donnees->adresse_siege_clt,
								'Commentaire'=> $donnees->comment_clt
							];
							$j++;
						}

					}elseif($donnees['type']==1){
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Contact::with(['societe'=> function($query){ $query
									->with(['groupe'])->select('nom_clt','id','groupe_id'); }])
									->findOrFail($value);
									$export[$key]= $profil;
								}
							}
							
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}elseif($donnees['type']==2){
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Groupe::findOrFail($value)->societe()->where('etat',1)->get();
									foreach ($profil as $pkey => $pvalue) {
										$export[$key]= $pvalue;
									}
								}
							}
							
								var_dump($export);
								dd();
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}
					$sheet->fromArray($extract);
				});
				
			})->export('xls');
		}

		// Import des contacts à partir du Groupe CRM
		if($request->input('export')){
			Excel::create('ExportContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$donnees = Input::all();
					$j = 0;
					if($donnees['type']==0){
						foreach ($donnees as $key => $value) {
							if(substr($key,0,1) == 'c'){
								$profil = Societe::findOrFail($value);
								$export[$key]= $profil;
							}
						}
						
						foreach($export as $donnees){
							$extract[$j] = [
								'Nom de la société'=>$donnees->nom_clt,
								'Effectif' => $donnees->effectif_clt,
								'Chiffre d\'affaire'=> $donnees->ca_clt,
								'N° TVA'=> $donnees->num_tva_clt,
								'URL'=> $donnees->url_clt,
								'Téléphone'=> $donnees->tel_siege_clt,
								'Fax'=> $donnees->fax_siege_clt,
								'E-mail'=> $donnees->email_siege_clt,
								'Pays'=> $donnees->pays_clt,
								'Ville'=> $donnees->ville_siege_clt,
								'Adresse'=> $donnees->adresse_siege_clt,
								'Commentaire'=> $donnees->comment_clt
							];
							$j++;
						}

					}else{
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Contact::with(['societe'=> function($query){ $query
									->with(['groupe'])->select('nom_clt','id','groupe_id'); }])
									->findOrFail($value);
									$export[$key]= $profil;
								}
							}
							
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}
					$sheet->fromArray($extract);
				});
				
			})->export('xls');
		}


		// Ajout de note
		if($request->input('add_note')){
			if($data['type']==0){
				echo 'Bonjour nouvelle';
				dd();
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Societe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}else{
				echo 'Contact';
			}
		}
		if($data['type']==0){
			return redirect(route('societe.index'));
		}else{
			return redirect(route('contact.index'));
		}
		
	}

	/********************************* ACTION POUR DOCUMENTS ***********************************/
	public function DeleteCheckedDocs(Request $request){
		$i = 1;
		$data = $request->all();
		if($request->input('supp')){
			if($data['type']==0 || $data['type']==3){
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Societe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}elseif($data['type']==1){

				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Contact::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}
				
			}elseif($data['type']==2){
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Groupe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}

		}


		// Import de contacts
		if($request->input('export')){
			Excel::create('ExportContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$donnees = Input::all();
					$j = 0;
					if($donnees['type']==0 || $donnees['type']==3){
						foreach ($donnees as $key => $value) {
							if(substr($key,0,1) == 'c'){
								$profil = Societe::findOrFail($value);
								$export[$key]= $profil;
							}
						}
						
						foreach($export as $donnees){
							$extract[$j] = [
								'Nom de la société'=>$donnees->nom_clt,
								'Effectif' => $donnees->effectif_clt,
								'Chiffre d\'affaire'=> $donnees->ca_clt,
								'N° TVA'=> $donnees->num_tva_clt,
								'URL'=> $donnees->url_clt,
								'Téléphone'=> $donnees->tel_siege_clt,
								'Fax'=> $donnees->fax_siege_clt,
								'E-mail'=> $donnees->email_siege_clt,
								'Pays'=> $donnees->pays_clt,
								'Ville'=> $donnees->ville_siege_clt,
								'Adresse'=> $donnees->adresse_siege_clt,
								'Commentaire'=> $donnees->comment_clt
							];
							$j++;
						}

					}elseif($donnees['type']==1){
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Contact::with(['societe'=> function($query){ $query
									->with(['groupe'])->select('nom_clt','id','groupe_id'); }])
									->findOrFail($value);
									$export[$key]= $profil;
								}
							}
							
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}elseif($donnees['type']==2){
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Groupe::findOrFail($value)->societe()->where('etat',1)->get();
									foreach ($profil as $pkey => $pvalue) {
										$export[$key]= $pvalue;
									}
								}
							}
							
								var_dump($export);
								dd();
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}
					$sheet->fromArray($extract);
				});
				
			})->export('xls');
		}

		// Import des contacts à partir du Groupe CRM
		if($request->input('export')){
			Excel::create('ExportContact',function($excel){
				$excel->sheet('Sheetname',function($sheet){
					$donnees = Input::all();
					$j = 0;
					if($donnees['type']==0){
						foreach ($donnees as $key => $value) {
							if(substr($key,0,1) == 'c'){
								$profil = Societe::findOrFail($value);
								$export[$key]= $profil;
							}
						}
						
						foreach($export as $donnees){
							$extract[$j] = [
								'Nom de la société'=>$donnees->nom_clt,
								'Effectif' => $donnees->effectif_clt,
								'Chiffre d\'affaire'=> $donnees->ca_clt,
								'N° TVA'=> $donnees->num_tva_clt,
								'URL'=> $donnees->url_clt,
								'Téléphone'=> $donnees->tel_siege_clt,
								'Fax'=> $donnees->fax_siege_clt,
								'E-mail'=> $donnees->email_siege_clt,
								'Pays'=> $donnees->pays_clt,
								'Ville'=> $donnees->ville_siege_clt,
								'Adresse'=> $donnees->adresse_siege_clt,
								'Commentaire'=> $donnees->comment_clt
							];
							$j++;
						}

					}else{
							foreach ($donnees as $key => $value) {
								if(substr($key,0,1) == 'c'){
									$profil = Contact::with(['societe'=> function($query){ $query
									->with(['groupe'])->select('nom_clt','id','groupe_id'); }])
									->findOrFail($value);
									$export[$key]= $profil;
								}
							}
							
							foreach($export as $donnees){
								$extract[$j] = [
									'Civilité'=>$donnees->genre_contact,
									'Nom' => $donnees->nom_contact,
									'Prénom'=> $donnees->prenoms_contact,
									'Société'=> isset($donnees->societe->nom_clt) ? $donnees->societe->nom_clt : NULL,
									'Groupe'=> isset($donnees->societe->groupe->nom_groupe) ? $donnees->societe->groupe->nom_groupe.' '.$donnees->societe->groupe->date_groupe : NULL,
									'Fonction'=> $donnees->fonction_contact,
									'Service'=> $donnees->service_contact,
									'Description'=> $donnees->description_contact,
									'Téléphone'=> $donnees->tel_contact,
									'E-mail'=> $donnees->email_contact,
									'Adresse'=> $donnees->adresse_contact
								];
								$j++;
							}
						}
					$sheet->fromArray($extract);
				});
				
			})->export('xls');
		}


		// Ajout de note
		if($request->input('add_note')){
			if($data['type']==0){
				echo 'Bonjour nouvelle';
				dd();
				foreach ($data as $key => $value) {
					if(substr($key,0,1) == 'c'){
						$profil = Societe::findOrFail($value);
						$profil->update(['etat'=>0]);
					}
				}

			}else{
				echo 'Contact';
			}
		}
		if($data['type']==0){
			return redirect(route('societe.index'));
		}else{
			return redirect(route('contact.index'));
		}
		
	}
}
