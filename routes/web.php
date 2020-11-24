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
// frontend
Route::get('/', 'HomeController@index')-> name('home.index');
// Route::get('home', 'HomeController@index')-> name('home.index');

// backend (admin)
Route::get('admin', 'AdminController@index')-> name('admin.index');
Route::get('dashboard', 'AdminController@show_dashboard')-> name('admin.show_dashboard');
Route::post('admin/dashboard', 'AdminController@dashboard')-> name('admin.dashboard');
Route::get('logout', 'AdminController@logout')-> name('admin.logout');
// backend (category)
Route::get('category/add_category', 'CategoryController@add_category')-> name('category.add_category');
Route::get('category', 'CategoryController@index')-> name('category.index');
Route::post('category/store', 'CategoryController@store')-> name('category.store');
//An/hien category
Route::get('category/unactive/{id}', 'CategoryController@unactive')->name('category.unactive');
Route::get('category/active/{id}', 'CategoryController@active')->name('category.active');
//Delete_category
Route::delete('category/delete/{id}', 'CategoryController@delete')->name('category.delete');
//Edit_category
Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');

// backend (brand)

Route::get('brand/add_brand', 'BrandController@add_brand')-> name('brand.add_brand');
Route::get('brand', 'BrandController@index')-> name('brand.index');
Route::post('brand/store', 'BrandController@store')-> name('brand.store');
//An/hien brand
Route::get('brand/unactive/{id}', 'BrandController@unactive')->name('brand.unactive');
Route::get('brand/active/{id}', 'BrandController@active')->name('brand.active');
//Delete brand
Route::delete('brand/delete/{id}', 'BrandController@delete')->name('brand.delete');
//Edit brand
Route::get('brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
Route::post('brand/update/{id}', 'BrandController@update')->name('brand.update');

// backend (Product)

Route::get('product/add_product', 'ProductController@add_product')-> name('product.add_product');
Route::get('product', 'ProductController@index')-> name('product.index');
Route::post('product/store', 'ProductController@store')-> name('product.store');
//An/hien product
Route::get('product/unactive/{id}', 'ProductController@unactive')->name('product.unactive');
Route::get('product/active/{id}', 'ProductController@active')->name('product.active');
//Delete product
// Route::get('product/delete/{id}', 'ProductController@delete')->name('product.delete');
Route::delete('product/delete/{id}', 'ProductController@delete')->name('product.delete');
//Edit product
Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('product/update/{id}', 'ProductController@update')->name('product.update');

//Phân loại sản phẩm theo Category
Route::get('category/statusby/{id}', 'CategoryController@showProductByCategory')->name('category.showProductByCategory');

//Phân loại sản phẩm theo brand
Route::get('brand/statusby/{id}', 'BrandController@showProductByBrand')->name('brand.showProductByBrand');
//Xem chi tiet san pham o trang home
Route::get('product_detail/{id}', 'ProductController@detail')->name('product.detail');
//add cart
Route::post('cart/add', 'CartController@store')->name('cart.store');
//show cart
Route::get('cart/show', 'CartController@index')->name('cart.index');
//xoa cart
Route::get('cart/{rowId}/delete', 'CartController@deleteByRowId')->name('cart.deleteByRowId');
//update cart
Route::get('cart/update', 'CartController@update')->name('cart.update');

//checkout login
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('users.showLoginForm');
//register account
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm')->name('users.showRegistrationForm');
//chon districts
Route::post('/showDistrict', 'RegisterController@showDistrict');
