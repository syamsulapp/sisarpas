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

Route::prefix('peminjaman')->group(function () {
    Route::get('alat_barang', [LandingControllers::class, 'alat_barang'])->name('peminjaman.alat_barang');
    Route::get('aula_barang', [LandingControllers::class, 'aula_barang'])->name('peminjaman.aula_barang');
});

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
    Route::middleware('user_middleware:user')->group(function () { //use session for next to dashboard user
        Route::get('dashboard', function () {
            return 'hello dashboard users';
        })->name('user.dashboard');
        Route::prefix('pinjam')->group(function () {
            Route::post('{id_barang}/barang', [])->name('pinjam.barang');
            Route::post('{id_barang}/aula', [])->name('pinjam.aula');
        });
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [AuthAdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AuthAdminController::class, 'doLogin'])->name('admin.login');
    });
    Route::middleware('admin_middleware:admin')->group(function () { //use session for next to dashboard admin
        Route::prefix('dashboard')->group(function () {
            Route::get('/', function () {
                return 'halo dashboard admin';
            })->name('admin.dashboard');
            Route::prefix('master_data')->group(function () {
                Route::get('/', function () {
                })->name('admin.dashboard.master-data-list');
            });
        });
    });
});
