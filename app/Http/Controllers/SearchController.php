<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Societe;
use App\Note;
use App\Devis;
use App\Livraison;
use App\Facture;
use App\Ligne;
use App\User;


class SearchController extends Controller
{
    public function searchableallannuaire(Request $request){

    }

    public function searchablesociete(Request $request)
    {
        
       
           
            $type = 0;
            $tri = 'none';
            $actif = 'contact';
            $societe = new Societe;

            if(isset($request->nom) && !empty($request->nom)){
                $mode = 'nom';
                $tri = 'alpha';
                $query = $request->nom;

                $societe->setSearchable( [
                                'columns' => [
                                    'nom_clt' => 10,
                                ],
                            ]);
                
                $societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
                
            }elseif($request->pays && !empty($request->pays)){
                $mode = 'pays';
                $tri = 'pays';
                $query = $request->pays;
                $societe->setSearchable ([
                                'columns' => [
                                    'pays_clt' => 10,
                                ],
                            ]);

                $societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            }elseif($request->tel && !empty($request->tel)){
                $mode = 'tel';
                $query = $request->tel;
                $societe->setSearchable ([
                                'columns' => [
                                    'tel_siege_clt' => 10,
                                ],
                            ]);
              
                $societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            }elseif($request->ville && !empty($request->ville)){
                $mode = 'ville';
                $tri = 'ville';
                $query = $request->ville;
                $societe->setSearchable ([
                                'columns' => [
                                    'ville_siege_clt' => 10,
                                ],
                            ]);
                $societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            }elseif($request->adresse && !empty($request->adresse)){
                $query = 'adresse';
                $mode = $request->adresse;
                $societe->setSearchable ([
                                'columns' => [
                                    'adresse_siege_clt' => 30,
                                ],
                            ]);
                $societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            }
            
            // Tri des résultats de la recherche 

            if(isset($_GET['sort'])){

            	$query = $_GET['query'];

            	// Tri sur recherche par nom 
            	if($_GET['mode']=='nom'){
            		$mode = 'nom';
            		if($_GET['sort']=='pays_clt'){
            			$tri = 'pays';
            		}elseif($_GET['sort']=='ville_siege_clt'){
            			$tri="ville";
            		}elseif($_GET['sort']=='statut'){
            			$tri="client";
            		}elseif($_GET['sort']=='nom_clt'){
            			$tri="alpha";
            		}elseif($_GET['sort']=='created_at'){
            			$tri="ajout";
            		}elseif($_GET['sort']=='updated_at'){
            			$tri="modif";
            		}elseif($_GET['sort']=='notes'){
            			$note = DB::table('societes')
            			            ->join('contacts', 'societes.id', '=', 'contacts.societe_id')
            			            ->join('notes', 'contacts.id', '=', 'notes.contact_id')
            			            ->select('societes.*', 'notes.*')->where('societes.etat',1)
            			            ->get();
            			$societe = $societe->search($query)->sortable()->where('etat',1)->get();
            			$tri = 'notes';

            			// Tri des contacts sans note
            			foreach ($societes as $key => $value) {
            				$exist = 0;
            				foreach ($note as $keyn => $valuen) {
            					if($value->nom_clt == $valuen->nom_clt){
            						$exist = 1;
            					}
            				}

            				if($exist==0){
            					$societe [] = $value;
            				}
            					
            			}
            		}
            		$societe->setSearchable ([
            		                'columns' => [
            		                    'nom_clt' => 10,
            		                ],
            		            ]);
            		$societe = $societe->search($query)->sortable()->where('etat',1)->get();
            		
            	}
            	// Tri sur recherche par pays
            	if($_GET['mode']=='pays'){
            	 	$mode = 'pays';
            	 	if($_GET['sort']=='pays_clt'){
            			$tri = 'pays';
            		}elseif($_GET['sort']=='ville_siege_clt'){
            			$tri="ville";
            		}elseif($_GET['sort']=='statut'){
            			$tri="client";
            		}elseif($_GET['sort']=='nom_clt'){
            			$tri="alpha";
            		}elseif($_GET['sort']=='created_at'){
            			$tri="ajout";
            		}elseif($_GET['sort']=='updated_at'){
            			$tri="modif";
            		}elseif($_GET['sort']=='notes'){
            			$tri="notes";
            		}
                	$societe->setSearchable ([
                                'columns' => [
                                    'pays_clt' => 10,
                                ],
                            ]);

                	$societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            		
            	}

            	// Tri sur recherche par téléphone
            	if($_GET['mode']=='tel'){
            	 	$mode = 'tel';
            	 	if($_GET['sort']=='pays_clt'){
            			$tri = 'pays';
            		}elseif($_GET['sort']=='ville_siege_clt'){
            			$tri="ville";
            		}elseif($_GET['sort']=='statut'){
            			$tri="client";
            		}elseif($_GET['sort']=='nom_clt'){
            			$tri="alpha";
            		}elseif($_GET['sort']=='created_at'){
            			$tri="ajout";
            		}elseif($_GET['sort']=='updated_at'){
            			$tri="modif";
            		}elseif($_GET['sort']=='notes'){
            			$tri="notes";
            		}
                	$societe->setSearchable ([
                                'columns' => [
                                    'tel_siege_clt' => 10,
                                ],
                            ]);

                	$societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            		
            	}

            	// Tri sur recherche par Ville
            	if($_GET['mode']=='ville'){
            	 	$mode = 'ville';
            	 	if($_GET['sort']=='pays_clt'){
            			$tri = 'pays';
            		}elseif($_GET['sort']=='ville_siege_clt'){
            			$tri="ville";
            		}elseif($_GET['sort']=='statut'){
            			$tri="client";
            		}elseif($_GET['sort']=='nom_clt'){
            			$tri="alpha";
            		}elseif($_GET['sort']=='created_at'){
            			$tri="ajout";
            		}elseif($_GET['sort']=='updated_at'){
            			$tri="modif";
            		}elseif($_GET['sort']=='notes'){
            			$tri="notes";
            		}
                	$societe->setSearchable ([
                                'columns' => [
                                    'ville_siege_clt' => 10,
                                ],
                            ]);

                	$societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            		
            	}

            	// Tri sur recherche par téléphone
            	if($_GET['mode']=='adresse'){
            	 	$mode = 'adresse';
            	 	if($_GET['sort']=='pays_clt'){
            			$tri = 'pays';
            		}elseif($_GET['sort']=='ville_siege_clt'){
            			$tri="ville";
            		}elseif($_GET['sort']=='statut'){
            			$tri="client";
            		}elseif($_GET['sort']=='nom_clt'){
            			$tri="alpha";
            		}elseif($_GET['sort']=='created_at'){
            			$tri="ajout";
            		}elseif($_GET['sort']=='updated_at'){
            			$tri="modif";
            		}elseif($_GET['sort']=='notes'){
            			$tri="notes";
            		}
                	$societe->setSearchable ([
                                'columns' => [
                                    'adresse_siege_clt' => 10,
                                ],
                            ]);

                	$societe = $societe->search($query)->sortable()->where('etat',1)->get(); 
            		
            	}

            }

        
            return view('contact.contact', compact('actif','societe','type','tri','query','mode'));
    }

    public function searchablecontact(Request $request){
    	$type = 1;
            $tri = 'none';
            $actif = 'contact';
            $contact = new Contact;
                
                if(isset($request->nom) && !empty($request->nom)){
                    $contact = new Contact;
                    $contact->setSearchable( [
                                    'columns' => [
                                        'nom_contact' => 10,
                                        'prenoms_contact' => 10,
                                    ],
                                ]);
                    
                    $query = $request->nom;
                    $contact = $contact->search($query)->where('etat',1)->get();  
                }elseif($request->tel && !empty($request->tel)){
                    $contact->setSearchable ([
                                    'columns' => [
                                        'tel_contact' => 10,
                                    ],
                                ]);
                  
                    $query = $request->tel;
                    $contact = $contact->search($query)->where('etat',1)->get();  
                }elseif($request->adresse && !empty($request->adresse)){
                    $contact->setSearchable ([
                                    'columns' => [
                                        'adresse_contact' => 30,
                                    ],
                                ]);
                    $query = $request->adresse;
                    $contact = $contact->search($query)->where('etat',1)->get();  
                }
            return view('contact.contact', compact('actif','contact','type','tri','query'));
    }

}
