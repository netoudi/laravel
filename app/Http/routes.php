<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'AdminCategoriesController@index');
        Route::get('/create', 'AdminCategoriesController@create');
        Route::post('/store', 'AdminCategoriesController@store');
        Route::get('/show/{id}', 'AdminCategoriesController@show');
        Route::get('/edit/{id}', 'AdminCategoriesController@edit');
        Route::put('/update/{id}', 'AdminCategoriesController@update');
        Route::delete('/destroy/{id}', 'AdminCategoriesController@destroy');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'AdminProductsController@index');
        Route::get('/create', 'AdminProductsController@create');
        Route::post('/store', 'AdminProductsController@store');
        Route::get('/show/{id}', 'AdminProductsController@show');
        Route::get('/edit/{id}', 'AdminProductsController@edit');
        Route::put('/update/{id}', 'AdminProductsController@update');
        Route::delete('/destroy/{id}', 'AdminProductsController@destroy');
    });

});
