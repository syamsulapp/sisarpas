<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Landing\LandingControllers;
use App\Http\Controllers\User\{AuthUserController, DashboardController};
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
    /**
     * authentikasi user
     */
    Route::prefix('auth')->group(function () {
        /**login */
        Route::get('login', [AuthUserController::class, 'login'])->name('user.login');
        Route::post('login', [AuthUserController::class, 'doLogin'])->name('user.login');
        /**logout */
        Route::post('logout', [AuthUserController::class, 'doLogout'])->name('user.logout');
        /**register */
        Route::get('register', [AuthUserController::class, 'register'])->name('user.register');
        Route::patch('register', [AuthUserController::class, 'doRegister'])->name('user.register');
        /**forgot password */
        Route::get('forgot_password', [AuthUserController::class, 'forgotPass'])->name('user.forgot_password');
        Route::post('forgot_password', [AuthUserController::class, 'doforgotPass'])->name('user.forgot_password');
        /**check reset password */
        Route::get('reset_password', [AuthUserController::class, 'resetPass'])->name('user.check_code_reset');
        Route::post('reset_password', [AuthUserController::class, 'doResetPass'])->name('user.check_code_reset');
    });
    /**
     * fitur user menggunakan session
     */
    Route::middleware('user_middleware:user')->group(function () { //use session for next to dashboard user
        /**
         * user dashboard setelah login (dashboard utama)
         */
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard');
        });
        /**
         * pinjam barang dan aula setelah login (booking)
         */
        Route::prefix('pinjam')->group(function () {
            Route::get('{id_barang}/barang', function ($id_barang) {
                return $id_barang;
            })->name('pinjam.barang');
            Route::get('{id_barang}/aula', function ($id_barang) {
                return $id_barang;
            })->name('pinjam.aula');
        });
    });
});

Route::prefix('admin')->group(function () {
    /**
     * authentikasi admin
     */
    Route::prefix('auth')->group(function () {
        Route::get('login', [AuthAdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AuthAdminController::class, 'doLogin'])->name('admin.login');
        Route::post('logout', [AuthAdminController::class, 'doLogout'])->name('admin.logout');
    });
    /**
     * fitur admin menggunakan session
     */
    Route::middleware('admin_middleware:admin')->group(function () {
        /**
         * dashboard admin setelah login (dashboard utama)
         */
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
            /**
             * master data dashboard
             */
            Route::prefix('master_data')->group(function () {
                Route::get('/', [])->name('admin.dashboard.master-data-list');
            });
            /**
             * rekap peminjaman barang dan aula
             */
            Route::prefix('rekap/peminjaman')->group(function () {
                Route::get('/', [])->name('admin.dashboard.rekap-peminjaman');
            });
        });
    });
});
