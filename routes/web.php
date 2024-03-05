<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Landing\LandingControllers;
use App\Http\Controllers\User\AuthUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingControllers::class, 'index'])->name('sisarpas.landing');


Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        /**
         * begin::register and login
         */
        Route::get('login', [AuthUserController::class, 'login'])->name('user.login');
        Route::post('login', [AuthUserController::class, 'doLogin'])->name('user.login');
        Route::get('register', [AuthUserController::class, 'register'])->name('user.register');
        Route::patch('register', [AuthUserController::class, 'doRegister'])->name('user.register');
        /**
         * end::register and login
         */
    });
    Route::middleware('user-middleware:user')->group(function () { //use session for next to dashboard user
        Route::get('dashboard', []);
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [AuthAdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AuthAdminController::class, 'doLogin'])->name('admin.login');
    });
    Route::middleware('admin-middleware:admin')->group(function () { //use session for next to dashboard admin
        Route::get('dashboard', []);
    });
});
