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

Route::get('/', 'StoreController@index');

Route::get('/home', 'StoreController@index');

Route::get('/category/{id}', ['as' => 'store.category', 'uses' => 'StoreController@category']);

Route::get('/product/{id}', ['as' => 'store.product', 'uses' => 'StoreController@product']);

Route::get('/tag/{id}', ['as' => 'store.tag', 'uses' => 'StoreController@tag']);

Route::get('/cart', ['as' => 'cart', 'uses' => 'CartController@index']);

Route::get('/cart/add/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add']);

Route::post('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);

Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@checkout']);
    Route::get('/checkout/placeOrder', ['as' => 'checkout.place', 'uses' => 'CheckoutController@place']);
    Route::get('/checkout/payment', ['as' => 'checkout.payment', 'uses' => 'CheckoutController@payment']);

    Route::get('/account', ['as' => 'account', 'uses' => 'AccountController@index']);
    Route::get('/account/orders', ['as' => 'account.orders', 'uses' => 'AccountController@orders']);

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {

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

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AdminOrdersController@index']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'AdminOrdersController@edit']);
        Route::patch('/update/{id}', ['as' => 'update', 'uses' => 'AdminOrdersController@update']);
    });

    Route::get('/email', function () {
        $order = \CodeCommerce\Order::all()->last();
        return view('emails.checkout', compact('order'));
    });

});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
