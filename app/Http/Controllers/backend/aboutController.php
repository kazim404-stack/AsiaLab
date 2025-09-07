<?php

namespace App\Http\Controllers\backend;

use App\DataTables\AboutUsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class aboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AboutUsDataTable $dataTable)
    {
        return $dataTable->render('admin.about.index');
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
    public function store(StoreAboutRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->file('image')) {
            $image = $request->file('image');
            $logo_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $logo_path = "backend/assets/images/about/" . $logo_name;
            $image->move(public_path("backend/assets/images/about/"), $logo_name);
            $validatedData["image"] = $logo_path;
        }
        AboutUs::create($validatedData);
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
        $about = AboutUs::findOrFail($id);
        $about->image = asset($about->image);
        return response()->json(["status" => "success", "data" => $about]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, AboutUs $about)
    {
        $validatedData = $request->validated();
        if ($request->file('image')) {
            if (!empty($about->image)) {
                $path = public_path($about->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $image = $request->file('image');
            $logo_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $logo_path = "backend/assets/images/about/" . $logo_name;
            $image->move(public_path("backend/assets/images/about/"), $logo_name);
            $validatedData["image"] = $logo_path;
        }
        $about->update($validatedData);
        return response()->json(["status" => "success", "message" => "Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $about = AboutUs::findOrFail($id);
            $path = public_path($about->image);
            if (is_file($path)) {
                unlink($path);
            }
            $about->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
