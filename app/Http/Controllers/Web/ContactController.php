<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /** @var Builder|Contact $contacts */
       $contacts = new Contact();

       if (!empty($request->name)) {
           $contacts = $contacts->where('name', 'LIKE', $request->name . "%");
       }

       if (!empty($request->last_name)) {
           $contacts = $contacts->where('last_name', 'LIKE', $request->last_name . "%");
       }

       if (!empty($request->email)) {
        $contacts = $contacts->where('email', 'LIKE', $request->email . "%");
        }

        if (!empty($request->phone)) {
            $contacts = $contacts->where('phone', 'LIKE', $request->phone . "%");
            }

       return response()->json($contacts->paginate(15), 200);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $input = $request->all();

        $contact = Contact::create($input['contact']);

        return response()->json(Contact::where('id',$contact->id)->first(), 200);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact = Contact::where('id', $contact->id)->with(['departament'])->first();
        return response()->json($contact, $contact ? 200 : 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('contacts/edit', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    { 
        $input = $request->all();
        $contact = $contact->update($input);

        return response()->json($contact); //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $delete = $contact->delete();

        return response()->json($delete, $delete ? 200 : 500);
    }

    public function getContractorContact(Request $request, $id)
    {
        $contacts = Contractor::findOrFail($id)->contacts()->paginate(5);
        return response()->json($contacts, $contacts ? 200 : 404);
    }

}