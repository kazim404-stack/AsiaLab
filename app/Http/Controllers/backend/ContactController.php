<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ContactsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\GeneralSetting;
use App\Models\Province;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactsDataTable $dataTable)
    {
        $generalSetting = GeneralSetting::first();
        $provinces = Province::all();
        return $dataTable->render('admin.contact.index', compact('generalSetting','provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $validatedData = $request->validated();
        Contact::create($validatedData);
        return response()->json(["status" => "success", "message" => "Added successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $generalSetting = GeneralSetting::first();
        $contact = Contact::findOrFail($id);
        $provinces = Province::all();
        return response()->json(["status" => "success",'generalSetting' => $generalSetting,'data' => $contact,'provinces' => $provinces]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
       $validatedData = $request->validated();
       $contact->update($validatedData);
       return response()->json(["status" => "success","message" => "Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            Contact::findOrFail($id)->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
