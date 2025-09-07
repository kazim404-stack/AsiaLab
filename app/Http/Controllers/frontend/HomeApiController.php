<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSendContactRequest;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\GeneralSetting;
use App\Models\KeyValue;
use App\Models\Slider;
use App\Models\Test;
use App\Models\Testimonail;
use App\Notifications\SendContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeApiController extends Controller
{

    public function about(Request $request)
    {
        $lang = $request->query('lang', app()->getLocale());
       
        $about = AboutUs::with(['aboutImages'])->where('type', 'about')->first();
        if (!$about) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json([
            'title' => $about->getTranslation('title', $lang),
            'description' => $about->getTranslation('description', $lang),
            'image' =>  $about->aboutImages,
        ]);
    }

    public function goals()
    {
        $local = app()->getLocale();
        $goals = KeyValue::where('type', 'goals')->get();
        $data = [];
        foreach ($goals as $goal) {
            $data[] = [
                "title" => $goal->getTranslation("title", $local),
                "description" => $goal->getTranslation("description", $local),
                "image" => $goal->image,
            ];
        }
        return response()->json(["status" => "success", "data" => $data], 200);
    }

    public function vision(Request $request)
    {
        $lang = $request->query('lang', app()->getLocale());
        $about = AboutUs::with(['aboutImages'])->where('type', 'vision')->first();
        if (!$about) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json([
            'title' => $about->getTranslation('title', $lang),
            'description' => $about->getTranslation('description', $lang),
            'image' =>  $about->aboutImages,
        ]);
    }
    public function mission(Request $request)
    {
        $lang = $request->query('lang', app()->getLocale());
        $about = AboutUs::with(['aboutImages'])->where('type', 'mission')->first();
        if (!$about) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json([
            'title' => $about->getTranslation('title', $lang),
            'description' => $about->getTranslation('description', $lang),
            'image' =>  $about->aboutImages,
        ]);
    }
    public function category()
    {
        $local = app()->getLocale();

        $categories = Category::where('parent_id', 0)->where('status', 1)->get();
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                "id" => $category->id,
                "parent_id" => $category->parent_id,
                "name" => $category->getTranslation('name', $local),
                "description" => $category->getTranslation('description', $local),
                "image" => $category->image,
            ];
        }
        return response()->json(["status" => "success", "data" => $data], 200);
    }
    // select cateogy with tests
    public function categoryTests(Request $request, string $categoryId)
    {
        $lang = $request->query('lang', app()->getLocale());

        $category = Category::with(['tests' => function ($query) {
            return $query->where('status', 1)->with('testImages');
        }])->find($categoryId);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        $data = [
            'id' => $category->id,
            'name' => $category->getTranslation('name', $lang),
            'description' => $category->getTranslation('description', $lang),
            'tests' => $category->tests->map(function ($test) use ($lang) {
                return [
                    'id' => $test->id,
                    'name' => $test->getTranslation('name', $lang),
                    'description' => $test->getTranslation('description', $lang),
                    'test_images' => $test->testImages->map(function ($image) {
                        return [
                            'id' => $image->id,
                            'test_id' => $image->test_id,
                            'image' => $image->image,
                            'is_primary' => $image->is_primary,
                        ];
                    }),
                ];
            }),
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }


    public function test(Request $request, string $categoryId)
    {
        $lang = $request->query('lang', app()->getLocale());

        // Get all tests for the given category
        $tests = Test::with([
            'category',
            'testImages'
        ])->where('status', 1)
            ->where('category_id', $categoryId)
            ->get();

        if ($tests->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No tests found'], 404);
        }

        $data = $tests->map(function ($test) use ($lang) {
            $testData = [
                'id' => $test->id,
                'name' => $test->getTranslation('name', $lang),
                'description' => $test->getTranslation('description', $lang),
                'test_images' => $test->testImages->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'image' => $image->image,
                        "is_primary" => $image->is_primary
                    ];
                }),
            ];

            if ($test->category) {
                $testData['category'] = [
                    'id' => $test->category->id,
                    'name' => $test->category->getTranslation('name', $lang),
                    'description' => $test->category->getTranslation('description', $lang),
                ];
            }
            return $testData;
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }





    public function slider()
    {
        $local = app()->getLocale();

        $sliders = Slider::with(['sliderImages' => function ($query) use ($local) {
            $query->where('type', $local);
        }])->where('status', 1)->get();

        $data = [];
        foreach ($sliders as $slider) {
            $data[] = [
                "id" => $slider->id,
                "title" => $slider->getTranslation('title', $local),
                "description" => $slider->getTranslation('description', $local),
                "images" => $slider->sliderImages->map(function ($img) {
                    return $img->image;
                }),
            ];
        }

        return response()->json(["status" => "success", "data" => $data], 200);
    }
    public function generalSetting(Request $request)
    {
        $lang = $request->query('lang', app()->getLocale());


        $generalSetting = GeneralSetting::with(['contacts' => function ($query) {
            return $query->where('status', 1)->with(['phones', 'province']);
        }])->first();
        if (!$generalSetting) {
            return response()->json([
                "status" => "error",
                "message" => "General setting not found"
            ], 404);
        }
        return response()->json([
            "status" => "success",
            "data" => [
                "id"        => $generalSetting->id,
                "site_name" => $generalSetting->site_name,
                "logo"      => $generalSetting->logo,
                "facebook"      => $generalSetting->facebook,
                "telegram"      => $generalSetting->telegram,
                "youtube"      => $generalSetting->youtube,
                "whatsapp"      => $generalSetting->whatsapp,
                "instagram"      => $generalSetting->instagram,
                "x"      => $generalSetting->x,
                "linkedin"      => $generalSetting->linkedin,
                "contacts"  => $generalSetting->contacts->map(function ($contact) use ($lang) {
                    return [
                        "id"    => $contact->id,
                        "general_setting_id"    => $contact->general_setting_id,
                        "email" => $contact->email,
                        "address" => $contact->getTranslation('address', $lang),
                        "phones" => $contact->phones->map(function ($phone) {
                            return [
                                "id" => $phone->id,
                                "phone_number" => $phone->phone_number,
                            ];
                        }),
                        "province" => $contact->province->province,
                    ];
                }),

            ]
        ], 200);
    }





    public function contact()
    {
        $contacts = Contact::all();
        return response()->json(["status" => "success", "data" => $contacts], 200);
    }
    public function keyValue()
    {
        $local = app()->getLocale();
        $keyValues = KeyValue::where('type', 'keyValues')->get();
        $data = [];
        foreach ($keyValues as $keyValue) {
            $data[] = [
                "title" => $keyValue->getTranslation("title", $local),
                "description" => $keyValue->getTranslation("description", $local),
                "image" => $keyValue->image,
            ];
        }
        return response()->json(["status" => "success", "data" => $data], 200);
    }
    public function testimonail()
    {
        $local = app()->getLocale();
        $testimonails = Testimonail::where('status', 1)->get();
        $data = [];
        foreach ($testimonails as $testimonail) {
            $data[] = [
                "name" => $testimonail->getTranslation('name', $local),
                "position" => $testimonail->getTranslation('position', $local),
                "description" => $testimonail->getTranslation('description', $local),
                "image" => $testimonail->image,
            ];
        }

        return response()->json(["status" => "success", "data" => $data], 200);
    }
    public function faq()
    {
        $local = app()->getLocale();
        $faqs = Faq::where('status', 1)->get();
        $data = [];
        foreach ($faqs as $faq) {
            $data[] = [
                "id" => $faq->id,
                "question" => $faq->getTranslation('question', $local),
                "answear" => $faq->getTranslation('answear', $local),
            ];
        }
        return response()->json(["status" => "success", "data" => $data], 200);
    }
    public function sendContact(StoreSendContactRequest $request)
    {
        $data = $request->validated();
        Notification::route('mail', 'info@asiamedlab.af')->notify(new SendContactForm($data));
        return response()->json(["status" => "success", "message" => "Send Successfully"]);
    }
    public function search(Request $request)
    {
        $query = $request->input('search_query');
        $lang = $request->input('lang', 'en');

        $products = Test::with(['category:id,name', 'testImages:id,test_id,image'])
            ->where(function ($q) use ($query, $lang) {
                $lowerQuery = strtolower($query);
                $q->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"'))) LIKE ?", ["%{$lowerQuery}%"]);
            })
            ->orWhereHas('category', function ($q) use ($query, $lang) {
                $lowerQuery = strtolower($query);
                $q->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$lang\"'))) LIKE ?", ["%{$lowerQuery}%"]);
            })
            ->take(25)
            ->orderBy('id', 'desc')
            ->get(['id', 'category_id', 'name']);
        $products->load('category:id,name');

        $products->transform(function ($item) use ($lang) {
            $translatedName = $item->getTranslation('name', $lang);
            $translatedCategoryName = $item->category ? $item->category->getTranslation('name', $lang) : null;

            $itemArray = $item->toArray();

            $itemArray['name'] = $translatedName;

            if (isset($itemArray['category'])) {
                $itemArray['category']['name'] = $translatedCategoryName;
            }

            if (!empty($itemArray['test_images'])) {
                foreach ($itemArray['test_images'] as &$img) {
                    $img['image'] = asset($img['image']);
                }
            }

            return $itemArray;
        });

        return response()->json([
            "status" => "success",
            "data" => $products
        ]);
    }
}
