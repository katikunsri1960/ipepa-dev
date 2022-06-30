<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokMataKuliah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pd_feeder_kelompok_mata_kuliah')->insert([
            [
                'id_kelompok_mata_kuliah' => 'A',
                'nama_kelompok_mata_kuliah' => 'MPK'
            ],
            [
                'id_kelompok_mata_kuliah' => 'B',
                'nama_kelompok_mata_kuliah' => 'MKK'
            ],
            [
                'id_kelompok_mata_kuliah' => 'C',
                'nama_kelompok_mata_kuliah' => 'MKB'
            ],
            [
                'id_kelompok_mata_kuliah' => 'D',
                'nama_kelompok_mata_kuliah' => 'MPB'
            ],
            [
                'id_kelompok_mata_kuliah' => 'E',
                'nama_kelompok_mata_kuliah' => 'MBB'
            ],
            [
                'id_kelompok_mata_kuliah' => 'F',
                'nama_kelompok_mata_kuliah' => 'MKU\/MKDU'
            ],
            [
                'id_kelompok_mata_kuliah' => 'G',
                'nama_kelompok_mata_kuliah' => 'MKDK'
            ],
            [
                'id_kelompok_mata_kuliah' => 'H',
                'nama_kelompok_mata_kuliah' => 'MKK'
            ],
        ]);
    }
}
