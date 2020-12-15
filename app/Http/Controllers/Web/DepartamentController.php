<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentStoreRequest;
use App\Models\Departament;
use App\Models\Contractor;
use App\Models\Contact;
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
            $departaments = $departaments->where('name', 'LIKE', $req->name . "%");
        }
        
        if(!empty($req->contractor_id)){
            $departaments = $departaments->where('contractor_id', '=', $req->contracor_id);
        }

        if(!empty($req->street)){
            $departaments = $departaments->where('street', 'LIKE', $req->street . "%");
        }

        if(!empty($req->city)){
            $departaments = $departaments->where('city', 'LIKE', $req->city . "%");
        }

        if(!empty($req->postal_code)){
            $departaments = $departaments->where('postal_code', 'LIKE', $req->postal_code . "%");
        }

        return response()->json($departaments->paginate(12), 200);
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
    public function store(DepartamentStoreRequest $request)
    {
        $input = $request->all();

        $departament = Departament::create($input['departament']);
        $contact = $departament->contacts()->create($input['contact']);

        return response()->json(Departament::where('id',$departament)->with(['departament.contacts']), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function show(Departament $departament)
    {
        $departament = $departament->where('id', $departament->id)->first();
        
        return response()->json($departament, $departament ? 200 : 404);
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
        $departament = $departament->update($request->all());

        return response()->json($departament);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departament $departament)
    {
        $delete = $departament->delete();

        return response()->json($delete, $delete ? 200 : 500);
    }

    public function getContractorDepartament(Request $request, $id)
    {
        $departaments = Contractor::findOrFail($id)->departaments()->paginate(5);
        return response()->json($departaments, $departaments ? 200 : 404);
    }

    public function getDepartamentContact(Request $request, $id)
    {
        $contacts = Departament::findOrFail($id)->contacts()->paginate(5);
        return response()->json($contacts, $contacts ? 200 : 404);
    }

    public function getDepartamentAll(Request $req){
        $departaments = new Departament();
        
        if(!empty($req->name)){
            $departaments = $departaments->where('name', 'LIKE', $req->name);
        }
        
        if(!empty($req->id)){
            $departaments = $departaments->where('id', '=', $req->id);
        }

        return response()->json($departaments->get(['name','id']), 200);
    }
}
