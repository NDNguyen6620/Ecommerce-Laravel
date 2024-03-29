<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::Class,'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/redirect', [HomeController::Class,'redirect']);
Route::get('/view_category', [AdminController::Class,'view_category']);
Route::post('/add_category', [AdminController::Class,'add_category']);
Route::get('/delete_category/{id}', [AdminController::Class,'delete_category']);
Route::post('/update_category', [AdminController::Class,'update_category']);


Route::get('/view_product', [AdminController::Class,'view_product']);
Route::post('/add_product', [AdminController::Class,'add_product']);
Route::get('/show_product', [AdminController::Class,'show_product']);
Route::get('/delete_product/{id}', [AdminController::Class,'delete_product']);
Route::get('/update_product/{id}', [AdminController::Class,'update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::Class,'update_product_confirm']);

Route::get('/show_orders', [AdminController::Class,'show_orders']);
Route::get('/order_detail/{id}', [AdminController::Class,'order_detail']);
Route::get('/delivered/{id}', [AdminController::Class,'delivered']);
Route::get('/print_pdf/{id}', [AdminController::Class,'print_pdf']);
Route::get('/search', [AdminController::Class,'search']);
Route::get('/search2', [AdminController::Class,'search2']);


Route::get('/product_details/{id}', [HomeController::Class,'product_details']);
Route::post('/add_cart/{id}', [HomeController::Class,'add_cart']);
Route::get('/show_cart', [HomeController::Class,'show_cart']);
Route::post('/update_cart', [HomeController::Class,'update_cart']);
Route::get('/remove_cart/{id}', [HomeController::Class,'remove_cart']);
Route::get('/cash_order', [HomeController::Class,'cash_order']);
Route::get('/show_order', [HomeController::Class,'show_order']);
Route::get('/show_order_detail/{id}', [HomeController::Class,'show_order_detail']);
Route::get('/cancel/{id}', [HomeController::Class,'cancel']);



Route::get('/product_search', [HomeController::Class,'product_search']);
Route::get('/category_search/{id}', [HomeController::Class,'category_search']);
Route::get('/all_product', [HomeController::Class,'all_product']);
Route::get('/contact', [HomeController::Class,'contact']);


















