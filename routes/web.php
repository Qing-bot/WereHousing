<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Models\History;

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

Route::get('/', function () {
    return view('login');
});

// //idk dibawah buat url2 nyas
// Route::get('/addItem', function () {
//     return view('home');
// });

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });


//yang bawah ini buat login register, masih on work
Route::post('login', [AuthController::class, 
    'login'])->name('login');

    Route::post('register', [AuthController::class, 
    'register'])->name('register');

    Route::post('logout', [AuthController::class, 
    'actionlogout'])->name('logout');

// Login -> Register Register -> login
Route::get('register', [AuthController::class, 
    'index_register'])->name('index_register')
    ;

Route::get('login', [AuthController::class, 
'index_login'])->name('index_login')
;

// Route::get('/profile', [UserController::class, 'index_profile'])->name('profile')->middleware('auth');
// Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

//Mavbar
Route::get('/profile', [HomeController::class,'showProfile'])->name('showProfile')->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');
Route::get('/history', [HistoryController::class, 'showHistory'])->name('showHistory')->middleware('auth');

//Homepage
Route::get('main', [HomeController::class,'index_home'])->name('index_home')->middleware('auth');
Route::get('main/search', [HomeController::class, 'viewPageSearch'])->name('main/search')->middleware('auth');
Route::get('addItem', [HomeController::class,'index_addItem'])->name('index_addItem')->middleware('auth');
Route::get('/addItem/create', [ItemController::class, 'createProduct'])->name('createProduct')->middleware('auth');
Route::post('/addItem', [ItemController::class, 'insertProduct'])->name('insertProduct')->middleware('auth');

Route::get('/productDetail/{id}', [ItemController::class, 'viewProductDetail'])->name('productDetail')->middleware('auth');
Route::patch('/productDetail/{id}', [ItemController::class, 'updateStock'])->name('updateStock')->middleware('auth');
Route::delete('/productDetail/{id}', [ItemController::class, 'deleteProduct'])->name('deleteProduct')->middleware('auth');

Route::get('/checkout', [ItemController::class, 'showCheckoutPage'])->name('checkout')->middleware('auth');
Route::post('/checkout', [ItemController::class, 'processCheckout'])->name('processCheckout')->middleware('auth');
Route::get('/add-stock', [ItemController::class, 'addStockPage'])->name('addStockPage')->middleware('auth');
Route::post('/add-stock', [ItemController::class, 'processAddStock'])->name('processAddStock')->middleware('auth');

Route::get('/product/{id}/edit', [ItemController::class, 'editProduct'])->name('editProduct')->middleware('auth');
Route::patch('/product/{id}', [ItemController::class, 'updateProduct'])->name('updateProduct')->middleware('auth');
