<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;

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
    return view('welcome',['name' => 'HELLO MF']);
});

/** REGISTER */
Route::get('/register',[AuthenticationController::class, 'register'])->name('register.create');
Route::post('/register',[AuthenticationController::class, 'registerStore'])->name('register.store');


Route::group(['middleware' => ['auth']],function(){
    Route::resources([
        'post' => PostController::class, 
        'tag' => TagController::class
    ]);
    
    /** LOGOUT */
    Route::post('/logout',[AuthenticationController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['guest']],function(){

    /** LOGIN */
    Route::get('/login',[AuthenticationController::class, 'login'])->name('login.create');
    Route::post('/login',[AuthenticationController::class, 'authenticate'])->name('login.authenticate');
});

