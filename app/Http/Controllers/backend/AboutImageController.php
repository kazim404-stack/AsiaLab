<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutImageRequest;
use App\Http\Requests\StoreAboutRequest;
use App\Models\AboutImage;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($aboutId)
    {
        $about = AboutUs::where('id',$aboutId)->first();
        $aboutImages = AboutImage::where('about_us_id',$aboutId)->get();
        return view('admin.aboutImage.index', compact('about', 'aboutId', 'aboutImages'));
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
    public function store(StoreAboutImageRequest $request, $aboutId)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = "backend/assets/images/about/" . $imageName;
                $image->move(public_path("backend/assets/images/about/"), $imageName);
                $validatedData['image'] = $imagePath;
                AboutImage::create([
                    "about_us_id" => $validatedData['about_us_id'],
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
    public function destroy(string $aboutId, String $image)
    {
        if ($image) {
            $aboutImage = AboutImage::findOrFail($image);
            $path = public_path($aboutImage->image);
            if (is_file($path)) {
                unlink($path);
            }
            $aboutImage->delete();
            $notification = [
                "alert-type" => "success",
                "message" => "Deleted successfully"
            ];
            return redirect()->route('admin.about.images.index', ['about' => $aboutId])->with($notification);
        }
    }
}
