<?php

use Illuminate\Support\Facades\Route;

Route::post('admin/products/search',  'App\Http\Controllers\Admin\ProductController@search')->name('products.search');
Route::resource('admin/products',App\Http\Controllers\Admin\ProductController::class);

Route::get('admin',function(){
})->name('admin');

Route::post('admin/categories/search',  'App\Http\Controllers\Admin\CategoryController@search')->name('categories.search');
Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
