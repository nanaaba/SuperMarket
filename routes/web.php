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

Route::get('/', 'HomeController@index');
Route::get('product/{productcode}', 'ProductController@showproductdetail');
Route::get('category/{categorycode}', 'CategoryController@showcategoryitems');

Route::get('category', function () {
    return view('category');
});



Route::get('/cart', function () {
    return view('shoppingcart');
});

Route::get('/checkout', function () {
    return view('checkout');
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

Route::get('/wishlist', function () {
    return view('wishlist');
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

//apis
Route::get('cart/cartitems', 'CartController@retreiveCartList');
Route::post('cart/add', 'CartController@addProductToCart');
Route::put('cart/update', 'CartController@updateCartList');
Route::delete('cart/delete/{itemkey}', 'CartController@removeProductFromCart');
Route::delete('cart/clear', 'CartController@clearCart');

Route::post('registeruser', 'UserAccountController@registerUser');

//



//category
Route::get('category/all', 'CategoryController@retreiveCategories');
Route::post('category/items', 'CategoryController@getCategoriesItems');
Route::get('category/items/{cattids}', 'CategoryController@retreiveCategoryProducts');
