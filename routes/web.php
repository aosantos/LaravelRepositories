<?php


//Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    
Route::post('admin/products/search',  'App\Http\Controllers\Admin\ProductController@search')->name('products.search');
Route::resource('admin/products',App\Http\Controllers\Admin\ProductController::class);


Route::post('admin/categories/search',  'App\Http\Controllers\Admin\CategoryController@search')->name('categories.search');
Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class);

Route::post('admin/users/search',  'App\Http\Controllers\Admin\UserController@search')->name('users.search');
Route::resource('admin/users',App\Http\Controllers\Admin\UserController::class);

//Route::get('/', 'DashboardController@index')->name('admin');

//});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

