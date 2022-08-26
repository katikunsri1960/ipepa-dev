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
        //get model prodi by ajax
        Route::get('fak-prodi', [App\Http\Controllers\Admin\AjaxSyncController::class, 'prodiId'])->name('get-fak-prodi');

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

        //Daftar Mahasiswa
        Route::get('daftar-mahasiswa', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'index'])->name('daftar-mahasiswa');
        Route::get('detail-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'detail'])->name('detail-mahasiswa');
        Route::get('histori-pendidikan/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'histori'])->name('histori-pendidikan');
        Route::get('aktivitas-perkuliahan/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'aktivitas'])->name('aktivitas-perkuliahan');
        Route::get('transkrip-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'transkrip'])->name('transkrip-mahasiswa');
        Route::get('krs-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'krs'])->name('krs-mahasiswa');

        //Profil PT
        Route::get('profil-pt', [App\Http\Controllers\AdminUniv\Profil_pt\ProfilPTController::class, 'index'])->name('profil-pt');

        //Daftar Dosen
        Route::get('daftar-dosen', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'index'])->name('daftar-dosen');
        Route::get('detail-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'detail'])->name('detail-dosen');
        Route::get('penugasan-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'penugasan'])->name('penugasan-dosen');
        Route::get('aktivitas-mengajar-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'aktivitas_mengajar'])->name('aktivitas-mengajar-dosen');
        Route::get('riwayat-fungsional-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'riwayat_fungsional'])->name('riwayat-fungsional-dosen');
        Route::get('riwayat-kepangkatan-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'riwayat_kepangkatan'])->name('riwayat-kepangkatan-dosen');
        Route::get('riwayat-pendidikan-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'riwayat_pendidikan'])->name('riwayat-pendidikan-dosen');
        Route::get('riwayat-sertifikasi-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'riwayat_sertifikasi'])->name('riwayat-sertifikasi-dosen');
        Route::get('riwayat-penelitian-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'riwayat_penelitian'])->name('riwayat-penelitian-dosen');

        //Penugasan Dosen
        Route::get('daftar-penugasan-dosen', [App\Http\Controllers\AdminUniv\Dosen\PenugasanDosenController::class, 'index'])->name('daftar-penugasan-dosen');
        Route::get('detail-daftar-penugasan-dosen/{id}', [App\Http\Controllers\AdminUniv\Dosen\PenugasanDosenController::class, 'detail'])->name('detail-daftar-penugasan-dosen');

        //Daftar Perkuliahan
        Route::get('daftar-mata-kuliah', [App\Http\Controllers\AdminUniv\Perkuliahan\PerkuliahanController::class, 'index'])->name('daftar-mata-kuliah');

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

            Route::get('call-akm', [App\Http\Controllers\Ajax\AjaxCallController::class, 'callAkm'])->name('call-akm');
            Route::get('dashboard-admin-prodi', [App\Http\Controllers\AdminProdi\DashboardController::class, 'index'])->name('dashboard-admin-prodi');

            //Mahasiswa
            Route::get('daftar-mahasiswa', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'index'])->name('daftar-mahasiswa');
            Route::get('detail-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'detail'])->name('detail-mahasiswa');
            Route::get('histori-pendidikan/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'histori'])->name('histori-pendidikan');
            Route::get('aktivitas-perkuliahan/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'aktivitas'])->name('aktivitas-perkuliahan');
            Route::get('transkrip-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'transkrip'])->name('transkrip-mahasiswa');
            Route::get('krs-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'krs'])->name('krs-mahasiswa');
            Route::get('krs-ajax', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'krs_ajax'])->name('krs-ajax');
            Route::get('histori-nilai/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'histori_nilai'])->name('histori-nilai');
            Route::get('prestasi-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Mahasiswa\MahasiswaController::class, 'prestasi'])->name('prestasi-mahasiswa');

            //Dosen
            Route::get('daftar-dosen', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'index'])->name('daftar-dosen');
        });
});
