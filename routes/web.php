<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backend\aboutController;
use App\Http\Controllers\backend\AboutImageController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\FaqController;
use App\Http\Controllers\backend\GeneralSettingController;
use App\Http\Controllers\backend\KeyValueController;
use App\Http\Controllers\backend\MachineImagesController;
use App\Http\Controllers\backend\MethodControllr;
use App\Http\Controllers\backend\PhoneController;
use App\Http\Controllers\backend\PhotoController;
use App\Http\Controllers\backend\ProvinceController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\Backend\SliderImageController;
use App\Http\Controllers\backend\TestController;
use App\Http\Controllers\backend\TestImageController;
use App\Http\Controllers\backend\TestimonailController;
use App\Http\Controllers\frontend\LocalController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{lang}', [LocalController::class, 'setLocal']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('/dashboard', function () {
    return view('admin.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::prefix('admin')->as('admin.')->middleware(['auth', 'verified'])->group(function () {
    // authentication route
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('do-logout', [AdminController::class, 'logOut'])->name('do.destory');
    Route::get('change-password', [AdminController::class, 'create'])->name('chnage.password.create');
    Route::post('user/change-password', [AdminController::class, 'chnagePassword'])->name('change.password');
    Route::get('profile-create', [AdminController::class, 'profileCreate'])->name('profile.profileCreate');
    Route::post('profile-change', [AdminController::class, 'profileChange'])->name('profile.profileChange');
    Route::get('users', [AdminController::class, 'usersList'])->name('users.usersList');
    Route::get('user/create', [AdminController::class, 'createUser'])->name('user.createUser');
    Route::post('user/store', [AdminController::class, 'addUser'])->name('user.addUser');
    Route::delete('user/delete/{id}', [AdminController::class, 'userDelete'])->name('user.userDelete');
    Route::get('user/edit/{id}', [AdminController::class, 'userEdit'])->name('user.userEdit');
    Route::post('user/update/{user}', [AdminController::class, 'userUpdate'])->name('user.userUpdate');
    Route::get('user/change/status', [AdminController::class, 'changeStatus'])->name('user.changeStatus');

    Route::resource('general-settings', GeneralSettingController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('phones', PhoneController::class);
     Route::resource('about.images', AboutImageController::class);
    Route::resource('about', aboutController::class);
    Route::get('get-categories', [CategoryController::class, 'getCategory'])->name('get.categories.getCategory');
    Route::resource('categories', CategoryController::class);
    Route::resource('machines', MachineController::class);
    Route::get('get-product-category', [TestController::class, 'getProductCategory'])->name('get.product.category');
    Route::resource('tests.images', TestImageController::class);
    Route::resource('tests', controller: TestController::class);
    Route::resource('slider-images', SliderImageController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('key-values', KeyValueController::class);
    Route::resource('testimonails', TestimonailController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('photos',PhotoController::class);
});

require __DIR__ . '/auth.php';
