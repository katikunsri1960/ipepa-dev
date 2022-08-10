<?php

use Illuminate\Support\Facades\Route;

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
    return view('frontend.index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    // Semua Routing Administrator masuk ke sini
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin',
        'as' => 'admin.',
    ], function() {

        Route::get('dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('sync-data', [App\Http\Controllers\Admin\AjaxSyncController::class, 'sync'])->name('sync-data');
        Route::get('sync-selected-data', [App\Http\Controllers\Admin\AjaxSyncController::class, 'syncSelected'])->name('sync-data-selected');
        Route::get('sync-data-process', [App\Http\Controllers\Admin\AjaxSyncController::class, 'syncProcess'])->name('sync-data-process');

        Route::resource('/sync', App\Http\Controllers\Admin\SyncController::class)->except(['show']);

        Route::group(
            [
                'prefix' => 'settings',
                'as' => 'settings.',
            ], function() {
                Route::resource('/users', App\Http\Controllers\Admin\Setting\UserController::class)->except(['show']);
                Route::resource('/api-configs', App\Http\Controllers\Admin\Setting\ApiController::class)->except(['show']);
                Route::resource('/frontend-configs', App\Http\Controllers\Admin\Setting\FrontendController::class)->except(['show']);
            }
        );

    });


    // Semua Routing Admin Universitas masuk ke sini
    Route::group([
        'prefix' => 'admin-univ',
        'middleware' => 'admin_univ',
        'as' => 'admin-univ.',
    ], function() {

        Route::get('dashboard-admin-univ', [App\Http\Controllers\AdminUniv\DashboardController::class, 'index'])->name('dashboard-admin-univ');
        Route::get('daftar-mahasiswa', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'index'])->name('daftar-mahasiswa');
        Route::get('profil-pt', [App\Http\Controllers\AdminUniv\Profil_pt\ProfilPTController::class, 'index'])->name('profil-pt');
        
    });


    // Semua Routing Admin Fakultas masuk ke sini
    Route::group([
        'prefix' => 'admin-fakultas',
        'middleware' => 'admin_fak',
        'as' => 'admin-fakultas.',], function() {

            Route::get('dashboard-admin-fakultas', [App\Http\Controllers\AdminFakultas\DashboardController::class, 'index'])->name('dashboard-admin-fakultas');
        });

    // Semua Routing Admin Prodi masuk ke sini
    Route::group([
        'prefix' => 'admin-prodi',
        'middleware' => 'admin_prodi',
        'as' => 'admin-prodi.',], function() {

            Route::get('dashboard-admin-prodi', [App\Http\Controllers\AdminProdi\DashboardController::class, 'index'])->name('dashboard-admin-prodi');
        });
});
