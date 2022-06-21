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
            ]
        ];

        SyncTable::insert($data);
    }
}
