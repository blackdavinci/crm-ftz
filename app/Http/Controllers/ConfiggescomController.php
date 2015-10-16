<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gescom;
use App\Http\Requests\CreateGescomRequest;
use DB;

class ConfiggescomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $actif = "gescom";
        $mode = 'gescom';
       
        $detail = DB::table('gescoms')->orderBy('created_at', 'desc')->first();
        return view('admin.param-config',compact('actif','mode','detail'));
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
        $mode = 'create-gescom';
        return view('admin.param-config',compact('actif','mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateGescomRequest $request)
    {
        //
       
        Gescom::create($request->all());
        return redirect('gescomconfig');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $actif = "gescom";
        $mode = 'gescom';
        $detail = Gescom::findOrFail($id);
        return view('admin.param-config',compact('actif','detail','mode'));
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
        $actif = "gescom";
        $mode = 'edit-gescom';
        $profil = Gescom::findOrFail($id);
        return view('admin.param-config',compact('actif','profil','mode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CreateGescomRequest $request, $id)
    {
        //
        Gescom::create($request->all());
        $profil = DB::table('gescoms')->select('id')->orderBy('created_at', 'desc')->first();
        $id = $profil->id;
        return redirect()->route('gescomconfig.show',[$id]);
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
