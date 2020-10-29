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

Route::get('/', function () {
    return view('welcome');
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
    }
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
