<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreSendContactRequest;
use App\Models\Test;
use App\Notifications\SendContactForm;

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
        $category = Category::with(['tests.testImages'])->where('id', $categoryId)->first();

        return view('frontend.pages.service_details', compact('category'));
    }
    public function sendContact(StoreSendContactRequest $request)
    {
        $data = $request->validated();
        Notification::route('mail', 'info@asialab.af')->notify(new SendContactForm($data));
        return response()->json(["status" => "success", "message" => "Send Successfully"]);
    }
    public function search(Request $request)
    {
        $query = trim($request->input('search-input'));
        if (preg_match('/[اآبپتثجچحخدذرزسشصضطظعغفقکگلمنوهی]/u', $query)) {
            $lang = 'da';
        } elseif (preg_match('/[ځښږګډۍې]/u', $query)) {
            $lang = 'pa';
        } else {
            $lang = 'en';
        }

        $lowerQuery = strtolower($query);


        $products = Test::with(['category:id,name', 'testImages:id,test_id,image'])
            ->where(function ($q) use ($query, $lang) {
                if ($lang === 'en') {
                    $q->whereRaw(
                        "LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"'))) LIKE ?",
                        ["%" . strtolower($query) . "%"]
                    );
                } else {
                    $search = str_replace(' ', '%', $query);
                    $q->whereRaw(
                        "JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"')) LIKE ?",
                        ["%{$search}%"]
                    );
                }
            })
            ->orWhereHas('category', function ($q) use ($query, $lang) {
                if ($lang === 'en') {
                    $q->whereRaw(
                        "LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"'))) LIKE ?",
                        ["%" . strtolower($query) . "%"]
                    );
                } else {
                    $search = str_replace(' ', '%', $query);
                    $q->whereRaw(
                        "JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"')) LIKE ?",
                        ["%{$search}%"]
                    );
                }
            })
            ->take(25)
            ->orderBy('id', 'desc')
            ->get();


        $products->transform(function ($item) use ($lang) {
            $item->name = $item->getTranslation('name', $lang);

            if ($item->category) {
                $item->category->name = $item->category->getTranslation('name', $lang);
            }

            if ($item->testImages->isNotEmpty()) {
                $item->testImages->transform(function ($img) {
                    $img->image = asset($img->image);
                    return $img;
                });
            }

            return $item;
        });



        if ($products->isNotEmpty()) {
            return view('frontend.pages.search_product', compact('products'));
        }

        return view('frontend.pages.search_product', ['products' => collect()]);
    }
}
