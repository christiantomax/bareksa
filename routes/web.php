<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AllocController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\CoController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Redis;

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


Route::get('/', [LoginController::class, 'index']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['guest']],function(){
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

Route::group(['middleware' => ['auth']],function(){
    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
    Route::get('/changepass', [LoginController::class, 'changepass']);
    Route::post('/changepass/post', [LoginController::class, 'changepasspost'])->name('changepasspost');

    Route::group(['middleware' => ['levelAdmin']],function(){
        // User Route
        Route::get('/user/setup', [UserController::class, 'index']);
        Route::post('/user/setup/create', [UserController::class, 'createUser'])->name('createUser');
        Route::get('/user/update/{kodeuser}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/user/update/post', [UserController::class, 'updateUserPost'])->name('updateUserPost');
        Route::post('/user/update/reset', [UserController::class, 'resetPass'])->name('resetPass');
        Route::post('/user/update/delete', [UserController::class, 'delUser'])->name('delUser');

        //Customer Route
        Route::get('/customer/setup', [CustomerController::class, 'index']);
        Route::post('/customer/setup/create', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::get('/customer/update/{kodecustomer}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
        Route::post('/customer/update/post', [CustomerController::class, 'updateCustomerPost'])->name('updateCustomerPost');
        Route::post('/Customer/update/delete', [CustomerController::class, 'delCustomer'])->name('delCustomer');
    });
});