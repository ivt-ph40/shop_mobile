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
//search
Route::post('/search', 'HomeController@search')->name('home.search');


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
//add cart by ajax
Route::post('/cart/add_by_ajax', 'CartController@add_by_ajax')->name('cart.add_by_ajax');
//show cart
Route::get('cart/show', 'CartController@index')->name('cart.index');
//show cart by ajax
Route::get('/giohang', 'CartController@giohang')->name('cart.giohang');
//update cart by ajax
Route::post('/update_cart_ajax', 'CartController@update_cart_ajax')->name('cart.update_cart_ajax');
//xóa cart bằng ajax
Route::get('/cart/{session_id}/delete_ajax', 'CartController@delete_ajax')->name('cart.delete_ajax');
//Xóa tất cả bằng ajax
Route::get('/cart/delete_all_ajax', 'CartController@delete_all_ajax')->name('cart.delete_all_ajax');
//xoa cart
Route::get('cart/{rowId}/delete', 'CartController@deleteByRowId')->name('cart.deleteByRowId');
//xóa tất cả
Route::get('cart/deleteAll', 'CartController@deleteAll')->name('cart.deleteAll');
//update cart
Route::get('cart/update', 'CartController@update')->name('cart.update');

//checkout login
Route::get('users/login', 'UserController@showLoginForm')->name('users.showLoginForm');
// login
Route::post('users/login', 'UserController@login')->name('users.login');
//logout
Route::get('users/logout', 'UserController@logout')->name('users.logout');
//register account
Route::get('users/register', 'UserController@showRegistrationForm')->name('users.showRegistrationForm');
//chon districts
Route::post('/showDistrict', 'UserController@showDistrict');
//cho wards
Route::post('/showWard', 'UserController@showWard');

//create account
Route::post('register', 'UserController@register')->name('register');
//add order
Route::get('/add_order', 'OrderController@create')->name('order.create');
//insert order
Route::post('/add_order', 'OrderController@store')->name('order.store');
//manage order
Route::get('/manage_order', 'OrderController@index')->name('order.index');
//xem thông tin order
Route::get('/manage_order/{id}/view', 'OrderController@view_order')->name('order.view_order');
//update qty
Route::post('/update-order-quantity', 'OrderController@update_order_quantity')->name('order.update_order_quantity');

//add images
Route::get('/image/add/{id}', 'ImageController@create')->name('image.create');
//chon anh
Route::post('/select_image', 'ImageController@select_image')->name('image.select_image');
//insert anh
Route::post('/insert_image/{product_id}', 'ImageController@store')->name('image.store');
//update ten anh o thu vien
Route::post('/update/image_name', 'ImageController@update')->name('image.update');
//xoa anh trong thu vien
Route::post('/delete_image', 'ImageController@destroy')->name('image.destroy');
Route::post('/update_image', 'ImageController@update_image')->name('image.update_image');

//COMMENT
//load comment
Route::post('/load_comment', 'ProductController@load_comment')->name('comment.load_comment');
//add comment
Route::post('/add_comment', 'ProductController@add_comment')->name('comment.add_comment');




//send mail
Route::get('/contact-us', 'HomeController@showContactForm')->name('contact.showContactForm');
//contact submit
Route::post('/contact-us', 'HomeController@sendMail')->name('contact.sendMail');
