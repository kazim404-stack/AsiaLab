<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
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
    public function store(StoreGalleryRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = "backend/assets/images/gallery/" . $imageName;
                $image->move(public_path("backend/assets/images/gallery/"), $imageName);
                $validatedData['image'] = $imagePath;
                Gallery::create([
                    "branch_name" => $validatedData['branch_name'],
                    "image" => $validatedData['image'],
                ]);
            }
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
    public function destroy(string $id)
    {
        if ($id) {
            $sliderImage = Gallery::findOrFail($id);
            $path = public_path($sliderImage->image);
            if (is_file($path)) {
                unlink($path);
            }
            $sliderImage->delete();
            $notification = [
                "alert-type" => "success",
                "message" => "Deleted successfully"
            ];

            return redirect()->back()->with($notification);
        }
    }
}
