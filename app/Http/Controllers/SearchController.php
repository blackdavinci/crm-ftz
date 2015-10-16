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
    public function searchableannuaire(Request $request)
    {
        
        $query = $request->q;

        if(isset($request->s_societe)){
           
            $type = 0;
            $tri = 'none';
            $actif = 'contact';
            
            if(isset($request->nom) && !empty($request->nom)){
                $societe = new Societe;
                $societe->setSearchable( [
                                'columns' => [
                                    'nom_clt' => 10,
                                ],
                            ]);
                
                $query = $request->nom;
                $societe = $societe->search($query)->where('etat',1)->get(); 
            }elseif($request->pays && !empty($request->pays)){
                $societe = new Societe;
                $societe->setSearchable ([
                                'columns' => [
                                    'pays_clt' => 10,
                                ],
                            ]);
                $query = $request->pays;
                $societe = $societe->search($query)->where('etat',1)->get(); 
            }elseif($request->tel && !empty($request->tel)){
                $societe = new Societe;
                $societe->setSearchable ([
                                'columns' => [
                                    'tel_siege_clt' => 10,
                                ],
                            ]);
              
                $query = $request->tel;
                $societe = $societe->search($query)->where('etat',1)->get(); 
            }elseif($request->ville && !empty($request->ville)){
                $societe = new Societe;
                $societe->setSearchable ([
                                'columns' => [
                                    'ville_siege_clt' => 10,
                                ],
                            ]);
                $query = $request->ville;
                $societe = $societe->search($query)->where('etat',1)->get(); 
            }elseif($request->adresse && !empty($request->adresse)){
                $societe = new Societe;
                $societe->setSearchable ([
                                'columns' => [
                                    'adresse_siege_clt' => 30,
                                ],
                            ]);
                $query = $request->adresse;
                $societe = $societe->search($query)->where('etat',1)->get(); 
            }
            

            return view('contact.contact', compact('actif','societe','type','tri','query'));

          
        }else{
            
            $type = 1;
            $tri = 'none';
            $actif = 'contact';
            $contact =  Contact::search($query)->where('etat',1)->get();

            if(isset($request->s_societe)){
               
                $type = 0;
                $tri = 'none';
                $actif = 'contact';
                
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
                    $contact = new Contact;
                    $contact->setSearchable ([
                                    'columns' => [
                                        'tel_contact' => 10,
                                    ],
                                ]);
                  
                    $query = $request->tel;
                    $contact = $contact->search($query)->where('etat',1)->get();  
                }elseif($request->adresse && !empty($request->adresse)){
                    $contact = new Contact;
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
}
