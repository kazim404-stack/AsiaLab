<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestImageRequest;
use App\Models\TestImage;
use Illuminate\Http\Request;

class TestImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($testId)
    {
        $testImages = TestImage::where('test_id',$testId)->get();
        return view('admin.testImage.index', compact('testId', 'testImages'));
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
    public function store(StoreTestImageRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            foreach ($request->File('image') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = "backend/assets/images/test_image/" . $imageName;
                $image->move(public_path('backend/assets/images/test_image/'), $imageName);
                $validatedData['image'] = $imagePath;
                TestImage::create($validatedData);
            }
        }
        return response()->json(["status" => "success", "message" => "Updated successfully"]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $testId, string $imageId)
    {
        if ($imageId) {
            $testImage = TestImage::findOrFail($imageId);
            $path = public_path($testImage->image);
            if (is_file($path)) {
                unlink($path);
            }
            $testImage->delete();
            return response()->json(["status" => "success", "message" => "Deleted successfully"]);
        }
    }
}
