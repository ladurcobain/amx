<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/',  [AuthController::class, 'index'])->name('login');
Route::get('login',  [AuthController::class, 'index'])->name('login');
Route::post('post-login',  [AuthController::class, 'loginPost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('error', [ErrorController::class, 'index'])->name('error.index');

Route::get('ajax/notif', [AjaxController::class, 'notif']);


Route::group(['middleware' => ['checkLogin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // USER
    Route::get('user/search', [UserController::class, 'search']);
    Route::post('user/filter', [UserController::class, 'filter'])->name('user.filter');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('user/password', [UserController::class, 'password'])->name('user.password');
    Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user/search', [UserController::class, 'search'])->name('user.search');
});

//Language Translation
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
