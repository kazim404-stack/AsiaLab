<?php

namespace App\Http\Controllers\backend;

use App\DataTables\KeyValuesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKeyValueRequest;
use App\Http\Requests\UpdateKeyValueRequest;
use App\Models\KeyValue;
use Illuminate\Http\Request;

class KeyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(KeyValuesDataTable $dataTable)
    {
        return $dataTable->render('admin.keyvalue.index');
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
    public function store(StoreKeyValueRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = "backend/assets/images/keyValue/" . $imageName;
            $image->move(public_path("backend/assets/images/keyValue/"), $imageName);
            $validatedData["image"] = $imagePath;
        }
        KeyValue::create($validatedData);
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
        $keyValue = KeyValue::findOrFail($id);
        $keyValue->image = asset($keyValue->image);
        return response()->json(["status" => "success", "data" => $keyValue]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeyValueRequest $request, KeyValue $keyValue)
    {

        $validatedData = $request->validated();
        if ($request->file('image')) {
            if (!empty($keyValue->image)) {
                $path = public_path($keyValue->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = "backend/assets/images/keyValue/" . $imageName;
            $image->move(public_path("backend/assets/images/keyValue/"), $imageName);
            $validatedData["image"] = $imagePath;
        }
        $keyValue->update($validatedData);
        return response()->json(["status" => "success", "message" => "updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $keyValue = KeyValue::findOrFail($id);
            if (!empty($keyValue->image)) {
                $path = public_path($keyValue->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $keyValue->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
