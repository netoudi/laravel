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
    return redirect()->route('admin.categories.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AdminCategoriesController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'AdminCategoriesController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'AdminCategoriesController@store']);
        Route::get('/show/{id}', ['as' => 'show', 'uses' => 'AdminCategoriesController@show']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'AdminCategoriesController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'AdminCategoriesController@update']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'AdminCategoriesController@destroy']);
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AdminProductsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'AdminProductsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'AdminProductsController@store']);
        Route::get('/show/{id}', ['as' => 'show', 'uses' => 'AdminProductsController@show']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'AdminProductsController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'AdminProductsController@update']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'AdminProductsController@destroy']);

        Route::group(['as' => 'images.'], function () {
            Route::get('/{id}/images', ['as' => 'index', 'uses' => 'AdminProductsController@images']);
            Route::get('/{id}/images/create', ['as' => 'create', 'uses' => 'AdminProductsController@createImage']);
            Route::post('/{id}/images/store', ['as' => 'store', 'uses' => 'AdminProductsController@storeImage']);
            Route::get('/{id}/images/destroy/{idImage}', ['as' => 'destroy', 'uses' => 'AdminProductsController@destroyImage']);
        });
    });

});
