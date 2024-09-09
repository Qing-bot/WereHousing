<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

//idk dibawah buat url2 nyas
Route::get('/addItem', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


//yang bawah ini buat login register, masih on work
Route::post('login', [AuthController::class, 
    'login'])->name('login');

    Route::post('register', [AuthController::class, 
    'register'])->name('register');

    Route::post('logout', [AuthController::class, 
    'logout'])->name('logout');

// Login -> Register Register -> login
Route::get('register', [AuthController::class, 
    'index_register'])->name('index_register')
    ;

Route::get('login', [AuthController::class, 
   'index_login'])->name('index_login')
   ;


//Mavbar
Route::get('profile', [HomeController::class,'index_profile'])->name('index_profile');
//Homepage
Route::get('main', [HomeController::class,'index_home'])->name('index_home');