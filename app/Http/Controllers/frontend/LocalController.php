<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalController extends Controller
{
    // public function setLocal($lang)
    // {
    //     if (in_array($lang, array_keys(config('languages')))) {
    //         session(['locale' => $lang]);
    //     }
    //     return redirect()->back();
    // }
    public function setLocal($lang)
    {
        if (in_array($lang, array_keys(config('languages')))) {
            session(['locale' => $lang]);
            App::setLocale($lang);
        }

        return redirect()->back();
    }
}
