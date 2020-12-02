<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Builder $contractors */
        $contractors = new Contractor();

        $contractors = $contractors->get(['id', 'name', 'nip']);

        return response()->json($contractors, 200);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Builder $contractors */
        $contractors = new Contractor();

        $contractors = $contractors->where("nip", $id)->with(['departaments:id,contractor_id,name,street,city,postal_code,country,is_main', 'departaments.contacts:id,departament_id,name,last_name,email,phone'])->firstOrFail(["id", "name", "join_date", "nip"]);

        return response()->json($contractors, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
