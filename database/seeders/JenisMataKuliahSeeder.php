<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pd_feeder_jenis_mata_kuliah')->insert([
            [
                'id_jenis_mata_kuliah' => 'A',
                'nama_jenis_mata_kuliah' => 'Wajib'
            ],
            [
                'id_jenis_mata_kuliah' => 'B',
                'nama_jenis_mata_kuliah' => 'Pilihan'
            ],
            [
                'id_jenis_mata_kuliah' => 'C',
                'nama_jenis_mata_kuliah' => 'Wajib Peminatan'
            ],
            [
                'id_jenis_mata_kuliah' => 'D',
                'nama_jenis_mata_kuliah' => 'Pilihan Peminatan'
            ],
            [
                'id_jenis_mata_kuliah' => 'S',
                'nama_jenis_mata_kuliah' => 'Tugas akhir\/Skripsi\/Tesis\/Disertasi'
            ],
        ]);
    }
}
