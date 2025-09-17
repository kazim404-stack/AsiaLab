<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function home()
    {
        return view('frontend.layouts.front_master');
    }
    public function about()
    {
        return view('frontend.pages.about_page');
    }
    public function service()
    {
        return view('frontend.pages.service_page');
    }
    public function contact()
    {
        return view('frontend.pages.contact_page');
    }
    public function gallery()
    {
        return view('frontend.pages.gallery_page');
    }
    public function serviceDetails($categoryId)
    {
        $category = Category::with(['tests.testImages'])->where('id',$categoryId)->first();

        return view('frontend.pages.service_details',compact('category'));
    }
}
