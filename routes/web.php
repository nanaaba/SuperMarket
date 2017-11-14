<?php

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

Route::group(['middleware' => 'usersession'], function () {
    Route::get('category/{categorycode}', 'CategoryController@showcategoryitems');
    Route::get('product/{productcode}', 'ProductController@showproductdetail');
    Route::get('/home', 'HomeController@index');
    Route::get('/wishlist', 'UserAccountController@showwishlist');
    Route::get('/wishlist/items/{bagid}', 'UserAccountController@showwishlistitems');
    Route::get('/myorders', 'UserAccountController@showuserorders');
    Route::get('addressbooks', 'UserAccountController@showuseraddresses');
    Route::get('promotion/{promotioncode}', 'ProductController@showpromotionitems');
    Route::get('/checkout', 'UserAccountController@showcheckout');


    Route::get('/cart', function () {
        return view('shoppingcart');
    });

   
    Route::get('/myaccount', function () {
        return view('myaccount');
    });
    Route::get('/orderhistory', function () {
        return view('orderhistory');
    });

    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/register', function () {
        return view('register');
    });



    Route::get('orderinformation', function () {
        return view('orderinformation');
    });

    Route::get('contact', function () {
        return view('contact');
    });
    Route::get('shoppingroom', function () {
        return view('shoppingroom');
    });
    Route::get('changepassword', function () {
        return view('forgotpasword');
    });



    Route::get('newsletters', function () {
        return view('shoppingroom');
    });
//apis
    Route::get('cart/cartitems', 'CartController@retreiveCartList');
    Route::post('cart/add', 'CartController@addProductToCart');
    Route::put('cart/update', 'CartController@updateCartList');
    Route::delete('cart/delete/{itemkey}', 'CartController@removeProductFromCart');
    Route::delete('cart/clear', 'CartController@clearCart');
    Route::post('cart/checkout', 'CartController@checkoutitems');

    
    
    //checkout
    Route::post('wishlist/add', 'UserAccountController@addWishlistItem');
    Route::delete('wishlist/items/remove/{bagid}/{itemid}', 'UserAccountController@removeShoppingBagItem');

    Route::post('registeruser', 'UserAccountController@registerUser');
    Route::post('reviewproduct', 'UserAccountController@addUserReview');
    Route::post('authenticateuser', 'UserAccountController@authenticateuser');
    Route::post('useraddresses', 'UserAccountController@addUserAddress');
    Route::post('checkoutregister', 'UserAccountController@checkoutregisterUser');
    Route::post('confirmcheckout', 'UserAccountController@orderItems');

    //confirmcheckout
//category
    Route::get('category/all', 'CategoryController@retreiveCategories');
    Route::post('category/items', 'CategoryController@getCategoriesItems');
    Route::get('category/items/{cattids}', 'CategoryController@retreiveCategoryProducts');
    Route::get('/logout', 'UserAccountController@logoutUser');
});

Route::get('/', 'HomeController@index');

