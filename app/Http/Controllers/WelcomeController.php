<?php namespace App\Http\Controllers;
use App\Preference;
use App\Note;
use App\Contact;
use App\Societe;
use App\Devis;
use App\Livraison;
use App\Facture;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$actif = 0; 
		$preference = Preference::first();
		$notes = Note::where('etat',1)->orderBy('created_at','desc')->paginate(5);
		$contacts = Contact::where('etat',1)->orderBy('created_at','desc')->paginate(5);
		$societes = Societe::where('etat',1)->orderBy('created_at','desc')->paginate(5);
		$devis = Devis::where('etat_devis',1)->orderBy('created_at','desc')->paginate(5);
		return view('accueil',compact('actif','preference','notes','contacts','societes','devis'));
	}
	
}
