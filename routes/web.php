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


//Phân quyền
Route::prefix('users')->group(function(){
	//list users
	Route::get('/list', 'UserController@index')->name('users.index')->middleware('check.roles:manage_users');
	//thêm users
	Route::get('/add', 'UserController@create')->name('users.create')->middleware('check.roles:manage_users');
	//insert user
	Route::post('/add', 'UserController@store')->name('users.store')->middleware('check.roles:manage_users');
	//sửa users
	Route::get('/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('check.roles:manage_users');
	//cập nhật users
	Route::post('/{id}/update', 'UserController@update')->name('users.update')->middleware('check.roles:manage_users');
	//xóa users
	Route::delete('/{id}/delete', 'UserController@destroy')->name('users.destroy')->middleware('check.roles:manage_users');
});

Route::prefix('roles')->group(function(){
	//danh sách vai trò
	Route::get('/', 'RoleController@index')->name('roles.index')->middleware('check.roles:manage_roles');
	//them vai tro
	Route::get('/add', 'RoleController@create')->name('roles.create')->middleware('check.roles:manage_roles');
	Route::post('/add', 'RoleController@store')->name('roles.store')->middleware('check.roles:manage_roles');
	//sửa vai trò
	Route::get('/{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('check.roles:manage_roles');
	//update vai trò
	Route::post('/{id}/update', 'RoleController@update')->name('roles.update')->middleware('check.roles:manage_roles');
	//xóa vai trò
	Route::delete('/{id}/delete', 'RoleController@destroy')->name('roles.destroy')->middleware('check.roles:manage_roles');
});

// backend (admin)
// Route::get('admin', 'AdminController@index')-> name('admin.index');
Route::get('dashboard', 'AdminController@show_dashboard')-> name('admin.show_dashboard')->middleware('check.roles:admin_dashboard');
// Route::post('admin/dashboard', 'AdminController@dashboard')-> name('admin.dashboard');
// Route::get('logout', 'AdminController@logout')-> name('admin.logout');

// backend (category)
Route::prefix('category')->group(function(){
	Route::get('/add_category', 'CategoryController@add_category')-> name('category.add_category')->middleware('check.roles:manage_categories');
	Route::get('/', 'CategoryController@index')-> name('category.index')->middleware('check.roles:manage_categories');
	Route::post('/store', 'CategoryController@store')-> name('category.store')->middleware('check.roles:manage_categories');
	//An/hien category
	Route::get('/unactive/{id}', 'CategoryController@unactive')->name('category.unactive')->middleware('check.roles:manage_categories');
	Route::get('/active/{id}', 'CategoryController@active')->name('category.active')->middleware('check.roles:manage_categories');
	//Delete_category
	Route::delete('/delete/{id}', 'CategoryController@delete')->name('category.delete')->middleware('check.roles:manage_categories');
	//Edit_category
	Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit')->middleware('check.roles:manage_categories');
	Route::post('/update/{id}', 'CategoryController@update')->name('category.update')->middleware('check.roles:manage_categories');
});


// backend (brand)
Route::prefix('brand')->group(function(){
	Route::get('/add_brand', 'BrandController@add_brand')-> name('brand.add_brand')->middleware('check.roles:manage_brands');
	Route::get('/', 'BrandController@index')-> name('brand.index')->middleware('check.roles:manage_brands');
	Route::post('/store', 'BrandController@store')-> name('brand.store')->middleware('check.roles:manage_brands');
	//An/hien brand
	Route::get('/unactive/{id}', 'BrandController@unactive')->name('brand.unactive')->middleware('check.roles:manage_brands');
	Route::get('/active/{id}', 'BrandController@active')->name('brand.active')->middleware('check.roles:manage_brands');
	//Delete brand
	Route::delete('/delete/{id}', 'BrandController@delete')->name('brand.delete')->middleware('check.roles:manage_brands');
	//Edit brand
	Route::get('/edit/{id}', 'BrandController@edit')->name('brand.edit')->middleware('check.roles:manage_brands');
	Route::post('/update/{id}', 'BrandController@update')->name('brand.update')->middleware('check.roles:manage_brands');
});

// backend (Product)
Route::prefix('product')->group(function(){
	Route::get('/add_product', 'ProductController@add_product')-> name('product.add_product')->middleware('check.roles:manage_products');
	Route::get('/', 'ProductController@index')-> name('product.index')->middleware('check.roles:manage_products');
	Route::post('/store', 'ProductController@store')-> name('product.store')->middleware('check.roles:manage_products');
	//An/hien product
	Route::get('/unactive/{id}', 'ProductController@unactive')->name('product.unactive')->middleware('check.roles:manage_products');
	Route::get('/active/{id}', 'ProductController@active')->name('product.active')->middleware('check.roles:manage_products');
	//Delete product
	Route::delete('/delete/{id}', 'ProductController@delete')->name('product.delete')->middleware('check.roles:manage_products');
	//Edit product
	Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('check.roles:manage_products');
	Route::post('/update/{id}', 'ProductController@update')->name('product.update')->middleware('check.roles:manage_products');
});
//backend (Permission)
Route::prefix('permission')->group(function(){
	//thêm permission
	Route::get('/add-permission', 'PermissionController@create')-> name('permission.create')->middleware('check.roles:manage_permissions');
	Route::post('/add-permission', 'PermissionController@store')-> name('permission.store')->middleware('check.roles:manage_permissions');
	//cập nhật permission
	Route::get('/{id}/edit-permission', 'PermissionController@edit')-> name('permission.edit')->middleware('check.roles:manage_permissions');
	Route::post('/{id}/update-permission', 'PermissionController@update')-> name('permission.update')->middleware('check.roles:manage_permissions');
	//xóa permission
	Route::delete('/{id}/delete-permission', 'PermissionController@destroy')-> name('permission.destroy')->middleware('check.roles:manage_permissions');
	//danh sách permission
	Route::get('/', 'PermissionController@index')-> name('permission.index')->middleware('check.roles:manage_permissions');
});

//MANAGE ORDER IN ADMIN 
Route::prefix('order')->group(function(){
	Route::get('/manage_order', 'OrderController@index')->name('order.index')->middleware('check.roles:manage_orders');
	//xem thông tin order
	Route::get('/manage_order/{id}/view', 'OrderController@view_order')->name('order.view_order')->middleware('check.roles:manage_orders');
	//update qty
	Route::post('/update-order-quantity', 'OrderController@update_order_quantity')->name('order.update_order_quantity')->middleware('check.roles:manage_orders');
});

//Phân loại sản phẩm theo Category in user
Route::get('category/statusby/{id}', 'CategoryController@showProductByCategory')->name('category.showProductByCategory');


//Phân loại sản phẩm theo brand in user
Route::get('brand/statusby/{id}', 'BrandController@showProductByBrand')->name('brand.showProductByBrand');

//Xem chi tiet san pham o trang home in user
Route::get('product_detail/{id}', 'ProductController@detail')->name('product.detail');



//add cart by ajax
Route::post('/cart/add_by_ajax', 'CartController@add_by_ajax')->name('cart.add_by_ajax');
//show cart by ajax
Route::get('/giohang', 'CartController@giohang')->name('cart.giohang');
//update cart by ajax
Route::post('/update_cart_ajax', 'CartController@update_cart_ajax')->name('cart.update_cart_ajax');
//xóa cart bằng ajax
Route::get('/cart/{session_id}/delete_ajax', 'CartController@delete_ajax')->name('cart.delete_ajax');
//Xóa tất cả bằng ajax
Route::get('/cart/delete_all_ajax', 'CartController@delete_all_ajax')->name('cart.delete_all_ajax');

//add cart
Route::post('cart/add', 'CartController@store')->name('cart.store');
//show cart
Route::get('cart/show', 'CartController@index')->name('cart.index');
//xoa cart
Route::get('cart/{rowId}/delete', 'CartController@deleteByRowId')->name('cart.deleteByRowId');
//xóa tất cả
Route::get('cart/deleteAll', 'CartController@deleteAll')->name('cart.deleteAll');
//update cart
Route::get('cart/update', 'CartController@update')->name('cart.update');


//checkout login in user
Route::get('users/login', 'UserController@showLoginForm')->name('users.showLoginForm');
// login in user
Route::post('users/login', 'UserController@login')->name('users.login');
//logout in user
Route::get('users/logout', 'UserController@logout')->name('users.logout');
//register account in user
Route::get('users/register', 'UserController@showRegistrationForm')->name('users.showRegistrationForm');
//create account in user
Route::post('register', 'UserController@register')->name('register');


//chon districts in user
Route::post('/showDistrict', 'UserController@showDistrict');
//cho wards in user
Route::post('/showWard', 'UserController@showWard');


//add order in user
Route::get('/add_order', 'OrderController@create')->name('order.create');
//insert order in user
Route::post('/add_order', 'OrderController@store')->name('order.store');

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
//reply comment
Route::post('/reply_comment', 'ProductController@reply_comment')->name('comment.reply_comment');
//add đánh giá
Route::post('/add_rating', 'ProductController@add_rating')->name('rating.add_rating');

//Quản lý profile cá nhân
//Cài đặt
Route::get('/users/setting', 'UserController@show_profile')->name('users.show_profile');
//cập nhật thông tin cá nhân
Route::get('/users/{id}/manage_profile', 'UserController@manage_profile')->name('users.manage_profile')->middleware('is.owner');
Route::post('/users/{id}/manage_profile', 'UserController@update_profile')->name('users.update_profile')->middleware('is.owner');
//xem thông tin cá nhân
Route::get('/users/{id}/info_profile', 'UserController@info_profile')->name('users.info_profile')->middleware('is.owner');
//thay đổi mật khẩu
Route::get('/users/{id}/change-password', 'UserController@form_change_password')->name('users.form_change_password')->middleware('is.owner');
Route::post('/users/{id}/change-password', 'UserController@change_password')->name('users.change_password')->middleware('is.owner');

//send mail
Route::get('/contact-us', 'HomeController@showContactForm')->name('contact.showContactForm');
//contact submit
Route::post('/contact-us', 'HomeController@sendMail')->name('contact.sendMail');
