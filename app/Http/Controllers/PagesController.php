<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	//

	public function index(){
		//

	}

	public function about(){
		//

		$data = [];
		$data['first'] = 'Ousmane';
		$data['last'] = 'Cissé';
		return view('pages.about',$data);
	}
	

}
