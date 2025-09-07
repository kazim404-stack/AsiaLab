<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TestimonailsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonalRequest;
use App\Http\Requests\UpdateTestimonalRequest;
use App\Models\Testimonail;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\TestMethod;

class TestimonailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TestimonailsDataTable $dataTable)
    {
        return $dataTable->render('admin.testimonail.index');
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
    public function store(StoreTestimonalRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = "backend/assets/images/testimonail/" . $imageName;
            $image->move(public_path("backend/assets/images/testimonail/"), $imageName);
            $validatedData["image"] = $imagePath;
        }
        Testimonail::create($validatedData);
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
        $testimonail = Testimonail::findOrFail($id);
        $testimonail->image = asset($testimonail->image);
        return response()->json(["status" => "success","data" => $testimonail]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonalRequest $request, Testimonail $testimonail)
    {
        $validatedData = $request->validated();
        if ($request->file(key: 'image')) {
            if (!empty($testimonail->image)) {
                $path = public_path($testimonail->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = "backend/assets/images/testimonail/" . $imageName;
            $image->move(public_path("backend/assets/images/testimonail/"), $imageName);
            $validatedData["image"] = $imagePath;
        }
        $testimonail->update($validatedData);
        return response()->json(["status" => "success", "message" => "updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $testimonail = Testimonail::findOrFail($id);
            if (!empty($testimonail->image)) {
                $path = public_path($testimonail->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $testimonail->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
