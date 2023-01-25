<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTranskrip implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {
        $data = ListMahasiswa::leftJoin('pd_feeder_transkrip_mahasiswa','pd_feeder_transkrip_mahasiswa.id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa');

        return $data->select('pd_feeder_list_mahasiswa.nim','pd_feeder_list_mahasiswa.nama_mahasiswa','pd_feeder_list_mahasiswa.nama_program_studi','pd_feeder_transkrip_mahasiswa.kode_mata_kuliah','pd_feeder_transkrip_mahasiswa.nama_mata_kuliah','pd_feeder_transkrip_mahasiswa.smt_diambil','pd_feeder_transkrip_mahasiswa.sks_mata_kuliah','pd_feeder_transkrip_mahasiswa.nilai_angka','pd_feeder_transkrip_mahasiswa.nilai_huruf','pd_feeder_transkrip_mahasiswa.nilai_indeks')->where('pd_feeder_list_mahasiswa.id_periode',$this->semester)->where('pd_feeder_list_mahasiswa.id_prodi',$this->program_studi)->get();
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'NAMA PROGRAM STUDI',
            'KODE MATA KULIAH',
            'NAMA MATA KULIAH',
            'SEMESTER DIAMBIL',
            'SKS MATA KULIAH',
            'NILAI ANGKA',
            'NILAI HURUF',
            'NILAI INDEKS'
        ];
    }
}