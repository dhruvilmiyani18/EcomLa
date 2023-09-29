<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductBookingController;
use App\Http\Controllers\StripePaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// fornt layouts page 
Route::get('/', [BaseController::class, 'home'])->name('home');
Route::get('/delivery', [BaseController::class, 'delivery'])->name('delivery');
Route::get('/contact', [BaseController::class, 'contact'])->name('contact');
Route::get('/cart', [BaseController::class, 'cart'])->name('cart');
Route::get('/product_summary/{id}', [BaseController::class, 'product_summary'])->name('product_summary');
Route::get('/product_view/{id}', [BaseController::class, 'product_view'])->name('product_view');
//user login register 
Route::get('/user/login', [BaseController::class, 'user_login'])->name('user.login');
Route::post('/user/login', [BaseController::class, 'insert_login'])->name('user.login');
Route::get('/user/register', [BaseController::class, 'user_register'])->name('user.register');
Route::post('/user/register', [BaseController::class, 'insert_register'])->name('user.register');
Route::get('/user/logout', [BaseController::class, 'logout'])->name('user.logout');
//user cart 
Route::post('/user/insertcart',[CartController::class,'create'])->name('insert.cart');
Route::get('/user/delete_cart',[CartController::class,'delete'])->name('delete.cart');
//Order routes
Route::post('/user/order',[ProductBookingController::class,'create'])->name('insert.order');
//user oder delete to frontside
Route::get('/user/oder_cancle',[BaseController::class,'oder_cancle'])->name('oder.cancle');
// admin pages
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/makelogin', [AdminController::class, 'makelogin'])->name('admin.makelogin');
//user conatct message
Route::post('/user/contact',[BaseController::class,'contact_message'])->name('contact.message');

Route::group(['middleware' => 'auth'], function () {
    //admin dashboard show and admin logout
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //admin add category
    Route::get('/admin/add_category', [CategoryController::class, 'index'])->name('add.category');
    Route::post('/admin/add_category', [CategoryController::class, 'store'])->name('store.category');
    // Route::get('/admin/category', [CategoryController::class, 'index'])->name('show.category');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edite'])->name('edit.category');
    Route::post('/admin/category/update_category/{id}', [CategoryController::class, 'update'])->name('update.category');
    Route::get('/admin/category/delete_category', [CategoryController::class, 'delete'])->name('delete.category');

    //admin add product
    Route::get('/admin/product', [ProductController::class, 'index'])->name('add.product');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('store.product');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::get('/admin/product/delete', [ProductController::class, 'destroy'])->name('delete.product');

    //admin product_details
    Route::get('/admin/product/product_details/{id}', [ProductController::class, 'product_details'])->name('product.detail');
    Route::post('/admin/product/product_details', [ProductController::class, 'product_details_store'])->name('product.details');
    Route::get('/admin/product/get_product_details',[ProductController::class,'get_product_details'])->name('get.product_details');
    
    //user data show in admin panel
    Route::get('/admin/show_user',[AdminController::class,'show_user'])->name('show.user');
    Route::post('/admin/delete_user',[AdminController::class,'delete_user'])->name('delete.user');

    //oder show in admin panel
    Route::get('/admin/oder/show_oder',[AdminController::class,'show_oder'])->name('show.oder');
    Route::get('/admin/delete_oder',[AdminController::class,'delete_oder'])->name('delete.oder');
    Route::get('/admin/oder_status',[AdminController::class,'oder_status'])->name('oder.status');
    
    // show user message
    Route::get('/admin/user_message',[AdminController::class,'user_message'])->name('show.user.message');
    //search routes
    Route::get('/admin/search/category', [CategoryController::class, 'search_category'])->name('search.category');
    Route::get('/admin/search/product', [ProductController::class, 'search_product'])->name('search.product');
    Route::get('/admin/search/user', [AdminController::class, 'search_user'])->name('search.user');

    
});

//stripe routes
Route::post('/stripe',[StripePaymentController::class,'stripePost'])->name('stripe.post');

//dropzon routes (img)
Route::post('projects/media', [ProductController::class, 'storeMedia'])->name('projects.storeMedia');
