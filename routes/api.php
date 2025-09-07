<?php

use App\Http\Controllers\frontend\HomeApiController;
use App\Http\Middleware\LocalizationMiddleware;

use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json(['status' => 'API working']);
});

Route::middleware([LocalizationMiddleware::class])->group(function () {
    Route::get('about', [HomeApiController::class, 'about'])->name('get.about');
    Route::get('goals', [HomeApiController::class, 'gloas'])->name('get.goals');
    Route::get('vision', [HomeApiController::class, 'vision'])->name('get.vision');
    Route::get('mission', [HomeApiController::class, 'mission'])->name('get.mission');
    Route::get('sliders', [HomeApiController::class, 'slider'])->name('get.slider');

    Route::get('category', [HomeApiController::class, 'category'])->name('get.category');
      Route::get('category-tests/{categoryId}', [HomeApiController::class, 'categoryTests'])->name('get.category.test');
    Route::get('test/{testId}', [HomeApiController::class, 'test'])->name('get.test');
    Route::get('general-settings', [HomeApiController::class, 'generalSetting'])->name('get.generalSetting');
    Route::get('contact', [HomeApiController::class, 'contact'])->name('get.contact');
    Route::get('key-value', [HomeApiController::class, 'keyValue'])->name('get.keyValue');
    Route::get('testimonail', [HomeApiController::class, 'testimonail'])->name('get.testimonail');
    Route::get('faq', [HomeApiController::class, 'faq'])->name('get.testimonail');
    Route::post("contact", [HomeApiController::class, 'sendContact'])->name('send.contact');
    Route::get("search", [HomeApiController::class, 'search'])->name('search');
});
