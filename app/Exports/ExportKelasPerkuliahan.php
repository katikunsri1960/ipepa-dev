<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKelasKuliah;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportKelasPerkuliahan implements FromCollection
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {
        $data = DetailKelasKuliah::select('nama_program_studi','nama_mata_kuliah','nama_kelas_kuliah','nama_status_mahasiswa','ips','sks_semester','ipk','sks_total','biaya_kuliah_smt')->where('pd_feeder_aktivitas_kuliah_mahasiswa.id_prodi', $this->program_studi)->where('pd_feeder_aktivitas_kuliah_mahasiswa.id_semester', $this->semester)->get();


        return $data;
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'PROGRAM STUDI',
            'STATUS MAHASISWA',
            'IPS',
            'JUMLAH SKS SEMESTER',
            'IPK',
            'JUMLAH SKS TOTAL',
            'BIAYA KULIAH SEMESTER'
        ];
    }
}
