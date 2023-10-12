<?php

namespace App\Imports;

use App\Models\DayaTampung;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class DtImport implements ToModel, SkipsEmptyRows
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DayaTampung([
            'jalur_ujian_id' => $row[0],
            'id_prodi' => $row[1],
            'kode_pusat' => $row[2],
            'tahun' => $row[3],
            'daya_tampung' => $row[4],
        ]);
    }
}
