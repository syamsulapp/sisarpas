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
Route::post('contact', [LandingControllers::class, 'contact'])->name('sisarpas.contact');

Route::prefix('peminjaman')->group(function () {
    Route::get('/alat/{kategori}', [LandingControllers::class, 'alat_barang'])->name('peminjaman.barang');
    Route::get('{kategori}/aula', [LandingControllers::class, 'alat_barang'])->name('peminjaman.ruangan');
    Route::post('cari/barang', [LandingControllers::class, 'cari_barang'])->name('peminjaman.cari.barang');
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
        /**check verify password */
        Route::get('check_verify_token', [AuthUserController::class, 'CheckVerifyToken'])->name('user.check_verify_token');
        Route::post('check_verify_token', [AuthUserController::class, 'doCheckVerifyToken'])->name('user.check_verify_token');
        /**check reset password */
        Route::get('reset/{token}/password', [AuthUserController::class, 'resetPass'])->name('user.reset_password');
        Route::post('reset_password', [AuthUserController::class, 'doResetPass'])->name('user_reset_password');
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
            Route::prefix('peminjaman')->group(function () {
                Route::get('/', [DashboardController::class, 'peminjaman'])->name('user.dashboard-peminjaman');
            });
        });
        /**
         * pinjam barang dan aula setelah login (booking)
         */
        Route::prefix('transaction')->group(function () {
            Route::get('{id}/pinjam', [LandingControllers::class, 'pinjam'])->name('transaction.pinjam.barang');
            Route::post('pinjam', [LandingControllers::class, 'doTransactionPinjam'])->name('transaction.submit.pinjam.barang');
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
                Route::prefix('landing')->group(function () {
                    Route::prefix('header')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'landingHeader'])->name('admin.dashboard_landing_header');
                        Route::post('create', [AdminDashboardController::class, 'doCreateLandingHeader'])->name('admin.dashboard_create_landing_header');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateLandingHeader'])->name('admin.dashboard_update_landing_header');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteLandingHeader'])->name('admin.dashboard_delete_landing_header');
                    });
                    Route::prefix('video')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'landingVideo'])->name('admin.dashboard_landing_video');
                        Route::post('create', [AdminDashboardController::class, 'doCreateLandingVideo'])->name('admin.dashboard_create_landing_video');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateLandingVideo'])->name('admin.dashboard_update_landing_video');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteLandingVideo'])->name('admin.dashboard_delete_landing_video');
                    });
                    Route::prefix('footer')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'landingFooter'])->name('admin.dashboard_landing_footer');
                        Route::post('create', [AdminDashboardController::class, 'doCreateLandingFooter'])->name('admin.dashboard_create_landing_footer');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateLandingFooter'])->name('admin.dashboard_update_landing_footer');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteLandingFooter'])->name('admin.dashboard_delete_landing_footer');
                    });
                    Route::prefix('informasi_penting')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'landingInformasiPenting'])->name('admin.dashboard_landing_informasi_penting');
                        Route::post('create', [AdminDashboardController::class, 'doCreateLandingInformasiPenting'])->name('admin.dashboard_create_landing_informasi_penting');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateLandingInformasiPenting'])->name('admin.dashboard_update_landing_informasi_penting');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteLandingInformasiPenting'])->name('admin.dashboard_delete_landing_informasi_penting');
                    });
                });
                Route::prefix('contacts')->group(function () {
                    Route::get('/', [AdminDashboardController::class, 'contacts'])->name('admin.dashboard_contacts');
                    Route::put('update', [AdminDashboardController::class, 'doUpdateContacts'])->name('admin.dashboard_update_contacts');
                    Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteContacts'])->name('admin.dashboard_delete_contacts');
                });
                Route::prefix('inventori')->group(function () {
                    Route::prefix('barang')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'barang'])->name('admin.dashboard_inventori_barang');
                        Route::post('create', [AdminDashboardController::class, 'doCreateBarang'])->name('admin.dashboard_inventori_create_barang');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateBarang'])->name('admin.dashboard_inventori_update_barang');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteBarang'])->name('admin.dashboard_inventori_delete_barang');
                    });
                    Route::prefix('ruangan')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'ruangan'])->name('admin.dashboard_inventori_ruangan');
                        Route::post('create', [AdminDashboardController::class, 'doCreateRuangan'])->name('admin.dashboard_inventori_create_ruangan');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateRuangan'])->name('admin.dashboard_inventori_update_ruangan');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteRuangan'])->name('admin.dashboard_inventori_delete_ruangan');
                    });
                    Route::prefix('admin')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'admininventori'])->name('admin.dashboard_inventori_admin');
                        Route::post('create', [AdminDashboardController::class, 'doCreateAdmin'])->name('admin.dashboard_inventori_create_admin');
                        Route::put('update', [AdminDashboardController::class, 'doUpdateAdmin'])->name('admin.dashboard_inventori_update_admin');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeleteAdmin'])->name('admin.dashboard_inventori_delete_admin');
                    });
                    Route::prefix('penjadwalan')->group(function () {
                        Route::get('/', [AdminDashboardController::class, 'penjadwalan_inventori'])->name('admin.dashboard_inventori_penjadwalan');
                        Route::post('create', [AdminDashboardController::class, 'doCreatePenjadwalan'])->name('admin.dashboard_inventori_create_penjadwalan');
                        Route::put('update', [AdminDashboardController::class, 'doUpdatePenjadwalan'])->name('admin.dashboard_inventori_update_penjadwalan');
                        Route::delete('{id}/delete', [AdminDashboardController::class, 'doDeletePenjadwalan'])->name('admin.dashboard_inventori_delete_penjadwalan');
                    });
                });
            });
            Route::prefix('peminjaman')->group(function () {
                Route::get('/', [AdminDashboardController::class, 'verifikasiPeminjaman'])->name('admin.dashboard_peminjaman');
                Route::post('verifikasi', [AdminDashboardController::class, 'doverifikasiPeminjaman'])->name('admin.dashboard_verifikasi_peminjaman');
                Route::get('{id}/{status}', [AdminDashboardController::class, 'doKembalikanBarangAtauAula'])->name('admin.dashboard_peminjaman_dikembalikan');
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
