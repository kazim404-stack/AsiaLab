<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ProvincesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProvincesDataTable $dataTable)
    {
        return $dataTable->render('admin.province.index');
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
    public function store(StoreProvinceRequest $request)
    {
        $validatedData = $request->validated();
        Province::create($validatedData);
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
        $province = Province::findOrFail($id);
        return response()->json(["status" => "success", "data" => $province]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
       $validatedData = $request->validated();
       $province->update($validatedData);
       return response()->json(["status" => "success","message" => "Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            Province::findOrFail($id)->delete();
            return response()->json(["status" => "success","message" => "Deleted successfully"]);
        }
    }
}
