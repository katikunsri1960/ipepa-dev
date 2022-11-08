<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportMataKuliah implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi)
    {
        $this->program_studi = $program_studi;
    }
    public function collection()
    {
        $data = MataKuliah::leftJoin('pd_feeder_jenis_mata_kuliah', 'pd_feeder_jenis_mata_kuliah.id_jenis_mata_kuliah', 'pd_feeder_mata_kuliah.id_jenis_mata_kuliah');

        return $data->select('kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah', 'nama_program_studi', 'nama_jenis_mata_kuliah')->where('pd_feeder_mata_kuliah.id_prodi', $this->program_studi)->get();
    }
    public function headings(): array
    {
        return [
            'KODE MATA KULIAH',
            'NAMA MATA KULIAH',
            'BOBOT MATA KULIAH (SKS)',
            'PROGRAM STUDI PENGAMPU',
            'JENIS MATA KULIAH'
        ];
    }
}
