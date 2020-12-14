<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $departaments = new Departament();
        if(!empty($req->name)){
            $departaments = $departaments->where('name', 'LIKE', $req->name);
        }
        
        if(!empty($req->contractor_id)){
            $departaments = $departaments->where('contractor_id', '=', $req->contracor_id);
        }

        if(!empty($req->street)){
            $departaments = $departaments->where('street', 'LIKE', $req->street);
        }

        if(!empty($req->city)){
            $departaments = $departaments->where('city', 'LIKE', $req->city);
        }

        if(!empty($req->postal_code)){
            $departaments = $departaments->where('postal_code', '=', $req->postal_code);
        }

        return response()->json($departaments, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function show(Departament $departament)
    {
        $departament = new Departament();

        $departament = $departament->get(['name', 'street', 'postal_code', 'city', 'country']);

        return response()->json($departament, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function edit(Departament $departament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departament $departament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departament $departament)
    {
        //
    }
}
