<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
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
        /** @var Builder|Contractor $contractors */
        $contractors = new Contractor();

        if (!empty($request->name)) {
            $contractors = $contractors->where('name', 'LIKE', $request->name . "%");
        }

        if (!empty($request->nip)) {
            $contractors = $contractors->where('NIP', 'LIKE', $request->nip . "%");
        }

        if (!empty($request->address)) {
            $contractors = $contractors->where(function ($query) use ($request) {
                /** @var QueryBuilder $query */
                $query->orWhere('city', 'LIKE', $request->address . "%")
                    ->orWhere('street', 'LIKE', $request->address . "%")
                    ->orWhere('country', 'LIKE', $request->address . "%")
                    ->orWhere('postal_code', 'LIKE', $request->address . "%");
            });
        }

        return view('contractors/index', ['contractors' => $contractors->paginate(15), 'filters' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contractors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['join_date'] = now();

        $contractor = Contractor::create($input);

        return redirect()->route('contractors.show', ['contractor' => $contractor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Contractor $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(Contractor $contractor)
    {
        return view('contractors/show', ['contractor' => $contractor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
        return view('contractors/edit', ['contractor' => $contractor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contractor $contractor)
    {
        $contractor = $contractor->update($request->all());

        return redirect()->route('contractors.show', ['contractor' => $contractor]);
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
