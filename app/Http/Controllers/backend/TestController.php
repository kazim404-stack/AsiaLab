<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TestsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Category;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TestsDataTable $dataTable)
    {
        return $dataTable->render('admin.test.index');
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
    public function store(StoreTestRequest $request)
    {
        $validatedData = $request->validated();
        $machineIds = $validatedData['machine_ids'] ?? [];
        unset($validatedData['machine_ids']);
        $test = Test::create($validatedData);
        if ($machineIds) {
            $test->machines()->sync($machineIds);
        }
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
        $test = Test::findOrFail($id);
        $category = Category::findOrFail($test->category_id);
        $getCategories = Category::getCategories();
        $html = view('admin.test.partial.edit', compact('category', 'getCategories'))->render();

        return response()->json(["status" => "success", 'data' => $test, 'html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $validatedData = $request->validated();
        if (isset($validatedData['machine_ids'])) {
            $test->machines()->sync($validatedData['machine_ids']);
            unset($validatedData['machine_ids']);
        }
        $test->update($validatedData);
        return response()->json([
            "status" => "success",
            "message" => "Updated successfully"
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $test = Test::findOrFail($id);
            $test->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
    public function getProductCategory()
    {
        $getCategories = Category::getCategories();
        $html = view('admin.test.partial.category', compact('getCategories'))->render();
        return response()->json(["status" => "success", "html" => $html]);
    }
}
