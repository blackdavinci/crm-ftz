<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateSocieteDataRequest;
use App\Http\Controllers\Controller;

use App\Societedata;
use DB;

class SocieteDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $actif = "profil";
        $mode = "profil";
        $profil = DB::table('societedatas')->orderBy('created_at', 'desc')->first();
         
        return view('admin.param-config',compact('actif','profil','mode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $actif = 'profil';
        $mode = 'new';
        return view('admin.param-config',compact('actif','mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateSocieteDataRequest $request)
    {
        //
        
        Societedata::create($request->all());
        return redirect(route('societedata.index'));
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
        $actif = "profil";
        $mode = 'profil';
        $profil = Societedata::findOrFail($id);
        return view('admin.param-config',compact('actif','profil','mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $profil = Societedata::findOrFail($id);
        $actif='profil';
        $mode = 'edit';
        return view('admin.param-config',compact('actif','profil','mode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CreateSocieteDataRequest $request, $id)
    {
        //
        $actif = "profil";

        $data = $request->except('photo');

        Societedata::create($data);

         $profil = DB::table('societedatas')->orderBy('created_at', 'desc')->first();
         $id = $profil->id;
         $profil = Societedata::findOrFail($id);


        /***** Adding Societe Logo *****/
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
		     
		     $profil->logo = $fileName;
		   
		     $profil->save();
		   
		}

        $profil = DB::table('societedatas')->select('id')->orderBy('created_at', 'desc')->first();

        return redirect()->route('societedata.show',[$id]);
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
