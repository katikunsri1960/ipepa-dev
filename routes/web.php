<?php

use Illuminate\Support\Facades\Auth;
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
    // return view('frontend.index');
    return redirect()->to('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::group(['middleware' => 'auth'], function () {

    // Semua Routing Administrator masuk ke sini
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth','admin'],
        'as' => 'admin.',
    ], function() {

        Route::get('dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('sync-data', [App\Http\Controllers\Admin\AjaxSyncController::class, 'sync'])->name('sync-data');
        Route::get('sync-selected-data', [App\Http\Controllers\Admin\AjaxSyncController::class, 'syncSelected'])->name('sync-data-selected');
        Route::get('sync-data-process', [App\Http\Controllers\Admin\AjaxSyncController::class, 'syncProcess'])->name('sync-data-process');
        //get model prodi by ajax
        Route::get('fak-prodi', [App\Http\Controllers\Admin\AjaxSyncController::class, 'prodiId'])->name('get-fak-prodi');

        Route::resource('/sync', App\Http\Controllers\Admin\SyncController::class)->except(['show']);
        Route::get('tesDnp', [App\Http\Controllers\Admin\SyncController::class, 'dnp'])->name('tesDnp');

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
        'middleware' => ['auth','admin_univ'],
        'as' => 'admin-univ.',
    ], function() {

        Route::get('dashboard-admin-univ', [App\Http\Controllers\AdminUniv\DashboardController::class, 'index'])->name('dashboard-admin-univ');

        //Daftar Mahasiswa
        Route::get('daftar-mahasiswa', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'index'])->name('daftar-mahasiswa');
        Route::get('get-mhs', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'getData'])->name('get-mhs');
        Route::get('detail-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'detail'])->name('detail-mahasiswa');
        Route::get('histori-pendidikan/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'histori'])->name('histori-pendidikan');
        Route::get('aktivitas-perkuliahan/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'aktivitas'])->name('aktivitas-perkuliahan');
        Route::get('detail-transkrip-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'transkrip'])->name('detail-transkrip-mahasiswa');
        Route::get('krs-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'krs'])->name('krs-mahasiswa');
        Route::get('krs-ajax', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'krs_ajax'])->name('krs-ajax');
        Route::get('histori-nilai/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'histori_nilai'])->name('histori-nilai');
        Route::get('prestasi-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Mahasiswa\MahasiswaController::class, 'prestasi'])->name('prestasi-mahasiswa');
        Route::get('export-daftar-mahasiswa', [App\Http\Controllers\AdminUniv\Mahasiswa\ExportController::class, 'daftar_mahasiswa'])->name('export-daftar-mahasiswa');

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
        Route::get('pembimbing-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'pembimbing_mahasiswa'])->name('pembimbing-aktivitas-mahasiswa');
        Route::get('penguji-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Dosen\DosenController::class, 'penguji_mahasiswa'])->name('penguji-aktivitas-mahasiswa');

        //Penugasan Dosen
        Route::get('daftar-penugasan-dosen', [App\Http\Controllers\AdminUniv\Dosen\PenugasanDosenController::class, 'index'])->name('daftar-penugasan-dosen');
        Route::get('detail-daftar-penugasan-dosen/{id}/{tahun}/{prodi}', [App\Http\Controllers\AdminUniv\Dosen\PenugasanDosenController::class, 'detail'])->name('detail-daftar-penugasan-dosen');

        //Daftar Perkuliahan
        Route::get('daftar-mata-kuliah', [App\Http\Controllers\AdminUniv\Perkuliahan\MataKuliahController::class, 'index'])->name('daftar-mata-kuliah');
        Route::get('mk-data', [App\Http\Controllers\AdminUniv\Perkuliahan\MataKuliahController::class, 'mk_data'])->name('mk-data');
        Route::get('mk-dev', [App\Http\Controllers\AdminUniv\Perkuliahan\MataKuliahController::class, 'mk_dev'])->name('mk-dev');
        Route::get('detail-mata-kuliah/{id}', [App\Http\Controllers\AdminUniv\Perkuliahan\MataKuliahController::class, 'detail_matkul'])->name('detail-mata-kuliah');
        Route::get('substansi-kuliah', [App\Http\Controllers\AdminUniv\Perkuliahan\SubstansiKuliahController::class, 'index'])->name('substansi-kuliah');
        Route::get('detail-substansi-kuliah/{id}', [App\Http\Controllers\AdminUniv\Perkuliahan\SubstansiKuliahController::class, 'detail'])->name('detail-substansi-kuliah');
        Route::get('kurikulum', [App\Http\Controllers\AdminUniv\Perkuliahan\KurikulumController::class, 'index'])->name('kurikulum');
        Route::get('detail-kurikulum/{id}', [App\Http\Controllers\AdminUniv\Perkuliahan\KurikulumController::class, 'detail'])->name('detail-kurikulum');
        Route::get('kelas-perkuliahan', [App\Http\Controllers\AdminUniv\Perkuliahan\KelasPerkuliahanController::class, 'index'])->name('kelas-perkuliahan');
        Route::get('detail-kelas-perkuliahan/{id}/{kelas_kuliah}/{semester}', [App\Http\Controllers\AdminUniv\Perkuliahan\KelasPerkuliahanController::class, 'detail'])->name('detail-kelas-perkuliahan');
        Route::get('nilai-perkuliahan', [App\Http\Controllers\AdminUniv\Perkuliahan\NilaiPerkuliahanController::class, 'index'])->name('nilai-perkuliahan');
        Route::get('detail-nilai-perkuliahan/{id}/{semester}', [App\Http\Controllers\AdminUniv\Perkuliahan\NilaiPerkuliahanController::class, 'detail'])->name('detail-nilai-perkuliahan');
        Route::get('aktivitas-kuliah-mahasiswa', [App\Http\Controllers\AdminUniv\Perkuliahan\AktivitasKuliahMahasiswaController::class, 'index'])->name('aktivitas-kuliah-mahasiswa');
        Route::get('detail-aktivitas-kuliah-mahasiswa/{id}/{semester}', [App\Http\Controllers\AdminUniv\Perkuliahan\AktivitasKuliahMahasiswaController::class, 'detail'])->name('detail-aktivitas-kuliah-mahasiswa');
        Route::get('aktivitas-mahasiswa', [App\Http\Controllers\AdminUniv\Perkuliahan\AktivitasMahasiswaController::class, 'index'])->name('aktivitas-mahasiswa');
        Route::get('detail-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminUniv\Perkuliahan\AktivitasMahasiswaController::class, 'detail'])->name('detail-aktivitas-mahasiswa');
        //revisi
        Route::get('kelas-perkuliahan-rev', [App\Http\Controllers\RevisiController::class, 'index'])->name('kelas-perkuliahan-rev');

        // Route::get('kampus-merdeka', [App\Http\Controllers\AdminUniv\Perkuliahan\PerkuliahanController::class, 'kampus_merdeka'])->name('kampus-merdeka');
        Route::get('mahasiswa-lulus-do', [App\Http\Controllers\AdminUniv\Perkuliahan\MahasiswaLulusDoController::class, 'index'])->name('mahasiswa-lulus-do');
        Route::get('detail-mahasiswa-lulus-do/{id}/{tahun}', [App\Http\Controllers\AdminUniv\Perkuliahan\MahasiswaLulusDoController::class, 'detail'])->name('detail-mahasiswa-lulus-do');
        Route::get('cek-transkrip-mahasiswa', [App\Http\Controllers\AdminUniv\Perkuliahan\CekTranskripMahasiswaController::class, 'index'])->name('cek-transkrip-mahasiswa');

        //Daftar Pelengkap
        Route::get('skala-nilai', [App\Http\Controllers\AdminUniv\Pelengkap\SkalaNilaiController::class, 'index'])->name('skala-nilai');
        Route::get('detail-skala-nilai/{id}', [App\Http\Controllers\AdminUniv\Pelengkap\SkalaNilaiController::class, 'detail'])->name('detail-skala-nilai');
        Route::get('periode-perkuliahan', [App\Http\Controllers\AdminUniv\Pelengkap\PeriodePerkuliahanController::class, 'index'])->name('periode-perkuliahan');
        Route::get('detail-periode-perkuliahan/{prodi}/{semester}', [App\Http\Controllers\AdminUniv\Pelengkap\PeriodePerkuliahanController::class, 'detail'])->name('detail-periode-perkuliahan');

        //Export Data
        Route::get('export-data', [App\Http\Controllers\AdminUniv\Export\ExportDataController::class, 'index'])->name('export-data');

        Route::get('pemantauan-lulusan', [App\Http\Controllers\AdminUniv\PemantauanController::class, 'index'])->name('pemantauan-lulusan');
        Route::get('pemantauan-length-studi', [App\Http\Controllers\AdminUniv\PemantauanController::class, 'length_studi'])->name('length-studi');
        Route::get('ajax-length-studi', [App\Http\Controllers\AdminUniv\PemantauanController::class, 'ajax_length_studi'])->name('ajax-length-studi');
        Route::get('dev-pemantauan', [App\Http\Controllers\AdminUniv\PemantauanController::class, 'dev'])->name('dev-pemantauan');
        Route::get('dev-ipepa', [App\Http\Controllers\AdminUniv\PemantauanController::class, 'dev_ipepa'])->name('dev-ipepa');
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
            Route::get('detail-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'detail'])->name('detail-dosen');
            Route::get('penugasan-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'penugasan'])->name('penugasan-dosen');
            Route::get('aktivitas-mengajar-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'aktivitas_mengajar'])->name('aktivitas-mengajar-dosen');
            Route::get('riwayat-fungsional-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'riwayat_fungsional'])->name('riwayat-fungsional-dosen');
            Route::get('riwayat-kepangkatan-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'riwayat_kepangkatan'])->name('riwayat-kepangkatan-dosen');
            Route::get('riwayat-pendidikan-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'riwayat_pendidikan'])->name('riwayat-pendidikan-dosen');
            Route::get('riwayat-sertifikasi-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'riwayat_sertifikasi'])->name('riwayat-sertifikasi-dosen');
            Route::get('riwayat-penelitian-dosen/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'riwayat_penelitian'])->name('riwayat-penelitian-dosen');
            Route::get('pembimbing-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'pembimbing_mahasiswa'])->name('pembimbing-aktivitas-mahasiswa');
            Route::get('penguji-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Dosen\DosenController::class, 'penguji_mahasiswa'])->name('penguji-aktivitas-mahasiswa');

            //Penugasan Dosen
            Route::get('daftar-penugasan-dosen', [App\Http\Controllers\AdminProdi\Dosen\PenugasanDosenController::class, 'index'])->name('daftar-penugasan-dosen');
            Route::get('detail-daftar-penugasan-dosen/{id}/{tahun}/{prodi}', [App\Http\Controllers\AdminProdi\Dosen\PenugasanDosenController::class, 'detail'])->name('detail-daftar-penugasan-dosen');

            //Perkuliahan
            Route::get('mata-kuliah', [App\Http\Controllers\AdminProdi\Perkuliahan\MataKuliahController::class, 'index'])->name('mata-kuliah');
            Route::get('detail-mata-kuliah/{id}', [App\Http\Controllers\AdminProdi\Perkuliahan\MataKuliahController::class, 'detail_matkul'])->name('detail-mata-kuliah');
            Route::get('substansi-kuliah', [App\Http\Controllers\AdminProdi\Perkuliahan\SubstansiKuliahController::class, 'index'])->name('substansi-kuliah');
            Route::get('detail-substansi-kuliah/{id}', [App\Http\Controllers\AdminProdi\Perkuliahan\SubstansiKuliahController::class, 'detail'])->name('detail-substansi-kuliah');
            Route::get('kurikulum', [App\Http\Controllers\AdminProdi\Perkuliahan\KurikulumController::class, 'index'])->name('kurikulum');
            Route::get('detail-kurikulum/{id}', [App\Http\Controllers\AdminProdi\Perkuliahan\KurikulumController::class, 'detail'])->name('detail-kurikulum');
            Route::get('kelas-perkuliahan', [App\Http\Controllers\AdminProdi\Perkuliahan\KelasPerkuliahanController::class, 'index'])->name('kelas-perkuliahan');
            Route::get('detail-kelas-perkuliahan/{id}/{kelas_kuliah}/{semester}', [App\Http\Controllers\AdminProdi\Perkuliahan\KelasPerkuliahanController::class, 'detail'])->name('detail-kelas-perkuliahan');
            Route::get('nilai-perkuliahan', [App\Http\Controllers\AdminProdi\Perkuliahan\NilaiPerkuliahanController::class, 'index'])->name('nilai-perkuliahan');
            Route::get('detail-nilai-perkuliahan/{id}/{semester}', [App\Http\Controllers\AdminProdi\Perkuliahan\NilaiPerkuliahanController::class, 'detail'])->name('detail-nilai-perkuliahan');
            Route::get('aktivitas-kuliah-mahasiswa', [App\Http\Controllers\AdminProdi\Perkuliahan\AktivitasKuliahMahasiswaController::class, 'index'])->name('aktivitas-kuliah-mahasiswa');
            Route::get('detail-aktivitas-kuliah-mahasiswa/{id}/{semester}', [App\Http\Controllers\AdminProdi\Perkuliahan\AktivitasKuliahMahasiswaController::class, 'detail'])->name('detail-aktivitas-kuliah-mahasiswa');
            Route::get('aktivitas-mahasiswa', [App\Http\Controllers\AdminProdi\Perkuliahan\AktivitasMahasiswaController::class, 'index'])->name('aktivitas-mahasiswa');
            Route::get('detail-aktivitas-mahasiswa/{id}', [App\Http\Controllers\AdminProdi\Perkuliahan\AktivitasMahasiswaController::class, 'detail'])->name('detail-aktivitas-mahasiswa');
            Route::get('mahasiswa-lulus-do', [App\Http\Controllers\AdminProdi\Perkuliahan\MahasiswaLulusDoController::class, 'index'])->name('mahasiswa-lulus-do');
            Route::get('detail-mahasiswa-lulus-do/{id}/{tahun}', [App\Http\Controllers\AdminProdi\Perkuliahan\MahasiswaLulusDoController::class, 'detail'])->name('detail-mahasiswa-lulus-do');

            //Profil PT
            Route::get('profil-pt', [App\Http\Controllers\AdminProdi\Profil_pt\ProfilPTController::class, 'index'])->name('profil-pt');

            //Daftar Pelengkap
            Route::get('skala-nilai', [App\Http\Controllers\AdminProdi\Pelengkap\SkalaNilaiController::class, 'index'])->name('skala-nilai');
            Route::get('detail-skala-nilai/{id}', [App\Http\Controllers\AdminProdi\Pelengkap\SkalaNilaiController::class, 'detail'])->name('detail-skala-nilai');
            Route::get('periode-perkuliahan', [App\Http\Controllers\AdminProdi\Pelengkap\PeriodePerkuliahanController::class, 'index'])->name('periode-perkuliahan');
            Route::get('detail-periode-perkuliahan/{prodi}/{semester}', [App\Http\Controllers\AdminProdi\Pelengkap\PeriodePerkuliahanController::class, 'detail'])->name('detail-periode-perkuliahan');

            //Export Data
            Route::get('export-data', [App\Http\Controllers\AdminProdi\Export\ExportDataController::class, 'index'])->name('export-data');

            //Pemantauan Lulusan
            Route::get('pemantauan-lulusan', [App\Http\Controllers\AdminProdi\PemantauanController::class, 'index'])->name('pemantauan-lulusan');
            Route::get('pemantauan-length-studi', [App\Http\Controllers\AdminProdi\PemantauanController::class, 'length_studi'])->name('length-studi');
            Route::get('dev-pemantauan', [App\Http\Controllers\AdminProdi\PemantauanController::class, 'dev'])->name('dev-pemantauan');
        });
});
