<?php

use App\Http\Controllers\Admin\ProductController;
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

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Auth::routes();

Route::group(
    ['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],
    function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        /* Categories */
        Route::resource('categories', '\App\Http\Controllers\Admin\CategoryController');
        /* Products */
        Route::resource('products', '\App\Http\Controllers\Admin\ProductController');
        Route::get('products/{product}/images', [ProductController::class, 'images'])->name('products.images');
        Route::get('products/{product}/add-image', [ProductController::class, 'addImage'])->name('products.add_images');
        Route::post('products/images/{image}', [ProductController::class, 'uploadImage'])->name('products.upload_images');
        Route::delete('products/images/{image}', [ProductController::class, 'deleteImage'])->name('products.remove_images');
        /* Product Attributes */
        Route::resource('attributes', '\App\Http\Controllers\Admin\AttributeController');
        Route::get('attributes/{attribute}/options', '\App\Http\Controllers\Admin\AttributeController@options')->name('attributes.options');
        Route::post('attributes/options/{attribute}', '\App\Http\Controllers\Admin\AttributeController@storeOption')->name('attributes.store_options');
        Route::delete('attributes/options/{option}', '\App\Http\Controllers\Admin\AttributeController@removeOption')->name('attributes.remove_options');
        Route::get('attributes/options/{option}/edit', '\App\Http\Controllers\Admin\AttributeController@editOption')->name('attributes.edit_options');
        Route::put('attributes/options/{option}', '\App\Http\Controllers\Admin\AttributeController@updateOption')->name('attributes.update_options');
    }
);

Route::get('/home', function () {
    return redirect('admin/dashboard');
})->name('home');

Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index'])->name('homes');
