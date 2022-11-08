<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAktivitasPerkuliahan implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {
        $data = AktivitasKuliahMahasiswa::select('nim','nama_mahasiswa','nama_program_studi','nama_status_mahasiswa','ips','sks_semester','ipk','sks_total','biaya_kuliah_smt')->where('pd_feeder_aktivitas_kuliah_mahasiswa.id_prodi', $this->program_studi)->where('pd_feeder_aktivitas_kuliah_mahasiswa.id_semester', $this->semester)->get();


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
