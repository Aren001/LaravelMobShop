<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/registrator',[UserController::class,'registerGet']);

Route::post('/registrator',[UserController::class,'registerPost']);
//

Route::get('/login',[UserController::class,'loginGet']);

Route::post('/login',[UserController::class,'loginPost']);

Route::get('/logout',[UserController::class,'logOut']);



// Route::get('/login',[UserController::class,'loginGet']);

// Route::post('/login',[UserController::class,'loginPost']);

// Route::get('/logout',[UserController::class,'logOut']);



//Products
Route::get('/',[ProductController::class,'index']);

//Details
Route::get("detail/{id}",[ProductController::class,'detail']);

//SEARCH
Route::get("search",[ProductController::class,'search']);
//CART
Route::post("add_to_cart",[ProductController::class,'addToCart']);

Route::get("cartlist",[ProductController::class,'cartList']); 

Route::get("removecart/{id}",[ProductController::class,'removeCart']); 
//ORDERS
Route::get("ordernow",[ProductController::class,'orderNow']);
Route::post("orderplace",[ProductController::class,'orderPlace']);
Route::get("myorders",[ProductController::class,'myOrders']);





//Admin Panel
Route::get('/adminPanel', [ProductController::class, 'show']);

//Add
Route::post('/adminPanel',[ProductController::class,'addData']);

//Delete
Route::get('delete/{id}',[ProductController::class,'delete']);

//EDit Update
Route::get('/editPanel/{id}',[ProductController::class,'edit']);

Route::post('/editPanel',[ProductController::class,'update']);
