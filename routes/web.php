<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{title}/{language}/{region}', [App\Http\Controllers\ProductController::class, 'show'])
->middleware('locale.region')->name('products.show');

Route::get('/{product}/{language?}/{region?}', function ($product, $language =null, $region=null) {

    if($language == null) {
        // set default = EN
        $default = 'en';
        $language = session('locale') ?? $default;
    }
    if($region == null) {
        // set default = AE
        $defaultRegion = 'ae';
        $region = session('region') ?? $defaultRegion;
    }

    return redirect( route('products.show', [$product, $language, $region]) );
})->middleware('locale.region');

Route::get('/', function() {
    return view('welcome');
});
