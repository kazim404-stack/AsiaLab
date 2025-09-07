<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SlidersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SlidersDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
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
    public function store(StoreSliderRequest $request)
    {
        $validatedData = $request->validated();
        // if ($request->file('image')) {
        //     $image = $request->file('image');
        //     $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        //     $imagePath = "backend/assets/images/slider/" . $imageName;
        //     $image->move(public_path("backend/assets/images/slider/"), $imageName);
        //     $validatedData["image"] = $imagePath;
        // }
        Slider::create($validatedData);
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
        $slider = Slider::findOrFail($id);
        $slider->image = asset($slider->image);
        return response()->json(["status" => "success", "data" => $slider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        // if ($request->file('image')) {
        //     if (!empty($slider->image)) {
        //         $path = public_path($slider->image);
        //         if (is_file($path)) {
        //             unlink($path);
        //         }
        //     }
        //     $image = $request->file('image');
        //     $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        //     $imagePath = "backend/assets/images/slider/" . $imageName;
        //     $image->move(public_path("backend/assets/images/slider/"), $imageName);
        //     $validatedData["image"] = $imagePath;
        // }
        $slider->update($validatedData);
        return response()->json(["status" => "success", "message" => "updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $slider = Slider::findOrFail($id);
            if (!empty($slider->image)) {
                $path = public_path($slider->image);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $slider->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
