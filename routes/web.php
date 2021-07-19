<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Artisan;
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
    return view('index');
});

Route::get("/login", function () {
    return view("login");
});

Route::get("/scrape-product", function () {
    $key1 = "keyboard";
    $key2 = "mouse";
    // dd(config('queue.default'));
    // dispatch(new App\Jobs\DataScraping\ShopeeProduct($key1))->onQueue("scrape-shopee-product");
});