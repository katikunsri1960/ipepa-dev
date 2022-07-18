<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SyncTable;

class SyncTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Feeder Negara',
                'table_name' => 'pd_negara',
                'api_path' => '/feeder/negara',
            ],
            [
                'name' => 'Feeder Agama',
                'table_name' => 'pd_feeder_agama',
                'api_path' => '/feeder/agama'
            ],
            [
                'name' => 'Feeder Jenis Tinggal',
                'table_name' => 'pd_feeder_jenis_tinggal',
                'api_path' => '/feeder/jenis-tinggal'
            ],
            [
                'name' => 'Feeder Alat Transportasi',
                'table_name' => 'pd_feeder_alat_transportasi',
                'api_path' => '/feeder/alat-transportasi'
            ],
            [
                'name' => 'Feeder Jenjang Pendidikan',
                'table_name' => 'pd_feeder_jenjang_pendidikan',
                'api_path' => '/feeder/jenjang-pendidikan'
            ],
            [
                'name' => 'Feeder Pekerjaan',
                'table_name' => 'pd_feeder_pekerjaan',
                'api_path' => '/feeder/pekerjaan'
            ],
            [
                'name' => 'Feeder Penghasilan',
                'table_name' => 'pd_feeder_penghasilan',
                'api_path' => '/feeder/penghasilan'
            ],
            [
                'name' => 'Feeder Wilayah',
                'table_name' => 'pd_feeder_wilayah',
                'api_path' => '/feeder/wilayah'
            ],
            [
                'name' => 'Feeder Kebutuhan Khusus',
                'table_name' => 'pd_feeder_kebutuhan_khusus',
                'api_path' => '/feeder/kebutuhan-khusus'
            ],
            [
                'nmae' => 'Feeder Pembiayaan',
                'table_name' => 'pd_feeder_pembiayaan',
                'api_path' => '/feeder/pembiayaan'
            ],
            [
                'nmae' => 'Feeder Jenis Daftar',
                'table_name' => 'pd_feeder_jenis_daftar',
                'api_path' => '/feeder/jenis-daftar'
            ],
            [
                'name' => 'Feeder Jalur Masuk',
                'table_name' => 'pd_feeder_jalur_masuk',
                'api_path' => '/feeder/jalur-masuk'
            ],
            [
                'name' => 'Feeder Program Studi',
                'table_name' => 'pd_feeder_program_studi',
                'api_path' => '/feeder/program-studi'
            ],
            [
                'name' => 'Feeder Perguruan Tinggi',
                'table_name' => 'pd_feeder_perguruan_tinggi',
                'api_path' => '/feeder/perguruan-tinggi'
            ],
            [
                'name' => 'Feeder Biodata Mahasiswa',
                'table_name' => 'pd_feeder_biodata_mahasiswa',
                'api_path' => '/feeder/biodata-mahasiswa'
            ],
            [
                'name' => 'Feeder Status Mahasiswa',
                'table_name' => 'pd_feeder_status_mahasiswa',
                'api_path' => '/feeder/status-mahasiswa',
            ],
            [
                'name' => 'Feeder Tahun Ajaran',
                'table_name' => 'pd_feeder_tahun_ajaran',
                'api_path' => '/feeder/tahun-ajaran',
            ],
            [
                'name' => 'Feeder Semester',
                'table_name' => 'pd_feeder_semester',
                'api_path' => '/feeder/semester',
            ],
            [
                'name' => 'Feeder Jenis Keluar',
                'table_name' => 'pd_feeder_jenis_keluar',
                'api_path' => '/feeder/jenis-keluar',
            ],
            [
                'name' => 'Feeder Bentuk Pendidikan',
                'table_name' => 'pd_feeder_bentuk_pendidikan',
                'api_path' => '/feeder/bentuk-pendidikan',
            ],
            [
                'name' => 'Feeder All Prodi',
                'table_name' => 'pd_feeder_all_prodi',
                'api_path' => '/feeder/all-prodi',
            ],
            [
                'name' => 'Feeder Profil PT',
                'table_name' => 'pd_feeder_profil_pt',
                'api_path' => '/feeder/profil-pt',
            ]
        ];

        SyncTable::insert($data);
    }
}
