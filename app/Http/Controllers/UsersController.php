<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\user;
use DB;
use Auth;
use App\Http\Requests\CreateUserRequest;
class UsersController extends Controller {

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

		$session = Auth::check();

		$actif = 'liste';
		$matchThese = ['etat'=>1];
		$users= User::select('id','name','prenom','role','fonction','active')->orderBy('name','asc')->where($matchThese)->get();
		
		return view('admin.user-config',compact('actif','users','session'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$actif = 'new';
		return view('admin.new-user',compact('actif'));
	}

	/***** Profil Picture Upload Method *****/
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{

		if(empty($request['username'])){
			$username = $request['prenom'].rand(0, 100).$request['name'].rand(0, 100);
		}else{
			$username = $request['username'];
		}

		User::create([
			'name' => $request['name'],
			'prenom' => $request['prenom'],
			'username' => $username,
			'role' => $request['role'],
			'password' => bcrypt($request['password']),
		]);
		$actif ="null";
		$password = $request['password'];
		$name = $request['name'];
		$prenom = $request['prenom'];
		return view('admin.create-info',compact('actif','username','password','name','prenom'));
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
		$actif = 'profil';
		$profil = User::findOrFail($id);
		return view('admin.user-config',compact('actif','profil'));
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
		$actif = 'edit';
		$profil = User::findOrFail($id);
		return view('admin.user-config',compact('actif','profil'));
	}

	/**
	 * Show the form for editing password.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function SetPassword($id)
	{
		//

		$actif = 'setpass';
		$profil = User::findOrFail($id);
		return view('admin.user-config',compact('actif','profil'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatepassword($id, Request $request)
	{

		$this->validate($request, [
		    'password' => 'required|min:6',
		]);

		$user = User::findOrFail($id);

		$user->password = bcrypt($request->password);

		$user->save();	  

		return  redirect(route('users.show', $id));
	}

	/**
	 * Update the user password in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$this->validate($request, [
		    'name' => 'required',
		    'prenom' => 'required',
		    'username' => 'required',
		]);

		
		$user = User::findOrFail($id);

		$data = $request->except('photo');

		
		
		$user->update($data);
	
		
		if($request->file('photo')!= null){

		$this->validate($request, [
		    'photo'=>'mimes:jpg,jpeg,png,bmp,gif',
		]);
		// getting all of the post data
		  $file = $request->file('photo');
		  // setting up rules
		 
		      $destinationPath = 'img/uploads'; // upload path
		      $extension = $request->file('photo')->getClientOriginalExtension(); // getting image extension
		      $fileName = rand(11111,99999).'.'.$extension; // renameing image
		      $request->file('photo')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		     
		     $user->photo = $fileName;
		     $user->save();
		      
		}

		return  redirect(route('users.show', $id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$profil = User::findOrFail($id);
		$profil->update(['etat'=>0]);
		return  redirect(route('societe.index'));
	}

	// Désactivation de l'utilisateur 
	public function desactived($id)
	{
		$profil = User::findOrFail($id);
		$profil->update(['active'=>0]);
		return  redirect(route('users.show',$id));
	}
}
