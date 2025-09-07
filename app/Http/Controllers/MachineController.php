<?php

namespace App\Http\Controllers;

use App\DataTables\MachinesDataTable;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Machine;
use App\Models\Method;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MachinesDataTable $dataTable)
    {
        $methods = Method::all();
        return $dataTable->render('admin.machine.index', compact('methods'));
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
    public function store(StoreMachineRequest $request)
    {
        $validatedData = $request->validated();
        Machine::create($validatedData);
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
        $machine = Machine::findOrFail($id);
        $methods = Method::all();
        return response()->json(["status" => "success","data" => $machine,'methods' => $methods]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        $validatedData = $request->validated();
        $machine->update($validatedData);
        return response()->json(["status" => "success","message" => "Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $machine = Machine::findOrFail($id);
            $machine->delete();
            return response()->json(["status" => "success","message" => "Deleted successfully"]);
        }
    }
}
