<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\BranchController;

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

    // PROVINSI
    Route::get('provinsi/search', [ProvinsiController::class, 'search']);
    Route::post('provinsi/filter', [ProvinsiController::class, 'filter'])->name('provinsi.filter');
    Route::get('provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
    Route::get('provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi.create');
    Route::post('provinsi/store', [ProvinsiController::class, 'store'])->name('provinsi.store');
    Route::get('provinsi/edit/{id}', [ProvinsiController::class, 'edit'])->name('provinsi.edit');
    Route::post('provinsi/update', [ProvinsiController::class, 'update'])->name('provinsi.update');
    Route::get('provinsi/destroy/{id}', [ProvinsiController::class, 'destroy'])->name('provinsi.destroy');
    Route::post('provinsi/search', [ProvinsiController::class, 'search'])->name('provinsi.search');

    // KOTA
    Route::get('kota/search', [KotaController::class, 'search']);
    Route::post('kota/filter', [KotaController::class, 'filter'])->name('kota.filter');
    Route::get('kota', [KotaController::class, 'index'])->name('kota.index');
    Route::get('kota/create', [KotaController::class, 'create'])->name('kota.create');
    Route::post('kota/store', [KotaController::class, 'store'])->name('kota.store');
    Route::get('kota/edit/{id}', [KotaController::class, 'edit'])->name('kota.edit');
    Route::post('kota/update', [KotaController::class, 'update'])->name('kota.update');
    Route::get('kota/destroy/{id}', [KotaController::class, 'destroy'])->name('kota.destroy');
    Route::post('kota/search', [KotaController::class, 'search'])->name('kota.search');

    // BRANCH
    Route::get('branch', [BranchController::class, 'index'])->name('branch.index');
    Route::post('branch/filter', [BranchController::class, 'filter'])->name('branch.filter');
    Route::get('branch/search', [BranchController::class, 'search']);
    Route::post('branch/search', [BranchController::class, 'search'])->name('branch.search');
    Route::get('branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('branch/update', [BranchController::class, 'update'])->name('branch.update');
    Route::get('branch/destroy/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');

});

//Language Translation
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
