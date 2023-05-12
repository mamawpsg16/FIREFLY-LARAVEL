<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AccountRecoveryQuestionController;

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
    return view('authentication.login',['name' => 'HELLO MF']);
});

/** REGISTER */
Route::get('/register',[AuthenticationController::class, 'register'])->name('register.create');
Route::post('/register',[AuthenticationController::class, 'registerStore'])->name('register.store');


Route::group(['middleware' => ['auth']],function(){
    Route::resources([
        /** POST */
        'post' => PostController::class, 
         /** TAG */
        'tag' => TagController::class,
         /** QUESTION */
        'question' => AccountRecoveryQuestionController::class,
        /** ROLE */
        'role' => RoleController::class,
        /** PERMISSION */
        'permission' => PermissionController::class,
        /** ADMIN */
        'admin' => AdminController::class,
    ]);
    
    /** LOGOUT */
    Route::post('/logout',[AuthenticationController::class, 'logout'])->name('logout');

    /** PROFILE */
    Route::get('/profile',[ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile',[ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{user:first_name}',[ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/toggleFollow',[ProfileController::class, 'toggleFollow'])->name('profile.toggleFollow');
    Route::get('/profile/search/user',[ProfileController::class,'search'])->name('profile.search');
    Route::get('/profile/search/results',[ProfileController::class,'searchResults'])->name('profile.results');

    /** MODULE */
    Route::get('module/access',[ModuleController::class, 'index'])->name('module.access');

});

Route::group(['middleware' => ['guest']],function(){

    /** LOGIN */
    Route::get('/login',[AuthenticationController::class, 'login'])->name('login.create');
    Route::post('/login',[AuthenticationController::class, 'authenticate'])->name('login.authenticate');
    /** RESET PASSWORD */
    Route::get('/account-recovery',[AuthenticationController::class,'forgotPassword'])->name('forgot-password');
    Route::post('/account-recovery/{email}',[AuthenticationController::class,'checkEmailIfExists'])->name('checkIfemailExists');
    Route::post('/account-recovery/verify/answer',[AuthenticationController::class,'verifyAnswer'])->name('verifyAnswer');
    Route::post('/account-recovery/change-password/reset',[AuthenticationController::class,'resetPassword'])->name('resetPassword');
});

