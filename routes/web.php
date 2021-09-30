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

Route::group(['namespace'=>'App\Http\Controllers\Admin','prefix'=>'admin'],function(){

    // admin login
    Route::get('/','AdminController@login')->name('admin.login');
    Route::post('/checkLogin','AdminController@checkLogin')->name('admin.checkLogin');



    Route::get('/home',function () {
        return view('home');
    })->name('home');


// admin categories
    Route::group(['prefix'=>'categories'],function () {
        Route::get('/','CategoryController@index')->name('categories.index');
        Route::get('/create','CategoryController@create')->name('categories.create');
        Route::post('/store','CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('categories.edit');
        Route::post('/update/{id}','CategoryController@update')->name('categories.update');
        Route::get('/delete/{id}','CategoryController@delete')->name('categories.delete');
        Route::get('/storeDelete','CategoryController@storeDelete')->name('categories.storeDelete');
        Route::get('/restore/{id}','CategoryController@restore')->name('categories.restore');
        
    });
    // admin menu
    Route::group(['prefix'=>'menus'],function () {
        Route::get('/','MenuController@index')->name('menus.index');
        Route::get('/create','MenuController@create')->name('menus.create');
        Route::post('/store','MenuController@store')->name('menus.store');
        Route::get('/edit/{id}','MenuController@edit')->name('menus.edit');
        Route::post('/update/{id}','MenuController@update')->name('menus.update');
        Route::get('/delete/{id}','MenuController@delete')->name('menus.delete');
    });

// admin product
    Route::group(['prefix'=>'products'],function () {
        Route::get('/','ProductController@index')->name('products.index');
        Route::get('/create','ProductController@create')->name('products.create');
        Route::post('/store','ProductController@store')->name('products.store');
        Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
        Route::post('/update/{id}','ProductController@update')->name('products.update');
        Route::get('/delete/{id}','ProductController@delete')->name('products.delete');
    });
// admin slider
    Route::group(['prefix'=>'sliders'],function () {
        Route::get('/','SliderController@index')->name('sliders.index');
        Route::get('/create','SliderController@create')->name('sliders.create');
        Route::post('/store','SliderController@store')->name('sliders.store');
        Route::get('/edit/{id}','SliderController@edit')->name('sliders.edit');
        Route::post('/update/{id}','SliderController@update')->name('sliders.update');
        Route::get('/delete/{id}','SliderController@delete')->name('sliders.delete');
    });
// admin settings
Route::group(['prefix'=>'settings'],function () {
    Route::get('/','SettingController@index')->name('settings.index');
    Route::get('/create','SettingController@create')->name('settings.create');
    Route::post('/store','SettingController@store')->name('settings.store');
    Route::get('/edit/{id}','SettingController@edit')->name('settings.edit');
    Route::post('/update/{id}','SettingController@update')->name('settings.update');
    Route::get('/delete/{id}','SettingController@delete')->name('settings.delete');
 
});

});




