<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'nama' => 'SNMPTN-SNBP',
        ], [
            'nama' => 'SBMPTN-SNBT',
        ], [
            'nama' => 'USMB',
        ]];

        DB::table('jalur_ujians')->insert($data);
    }
}
