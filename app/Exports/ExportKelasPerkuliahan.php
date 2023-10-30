<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKelasKuliah;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportKelasPerkuliahan implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {
        $data = DetailKelasKuliah::leftJoin('pd_feeder_mata_kuliah','pd_feeder_mata_kuliah.id_matkul','=','pd_feeder_detail_kelas_kuliah.id_matkul');


        return $data->select('pd_feeder_detail_kelas_kuliah.nama_program_studi','pd_feeder_detail_kelas_kuliah.nama_mata_kuliah','pd_feeder_detail_kelas_kuliah.nama_kelas_kuliah','sks_mata_kuliah')
        ->where('pd_feeder_detail_kelas_kuliah.id_prodi', $this->program_studi)->where('pd_feeder_detail_kelas_kuliah.id_semester', $this->semester)
        ->addSelect(DB::raw('(SELECT COUNT(id_registrasi_mahasiswa) FROM `krs_mahasiswa` WHERE krs_mahasiswa.id_matkul=pd_feeder_detail_kelas_kuliah.id_matkul AND krs_mahasiswa.id_kelas=pd_feeder_detail_kelas_kuliah.id_kelas_kuliah) AS jumlah_mahasiswa'))
        ->addSelect(DB::raw('(SELECT COUNT(id_registrasi_dosen) FROM `pd_feeder_aktivitas_mengajar_dosen` WHERE pd_feeder_aktivitas_mengajar_dosen.id_matkul=pd_feeder_detail_kelas_kuliah.id_matkul AND pd_feeder_aktivitas_mengajar_dosen.id_kelas=pd_feeder_detail_kelas_kuliah.id_kelas_kuliah) AS jumlah_dosen'))
        ->orderby('pd_feeder_detail_kelas_kuliah.kode_mata_kuliah','ASC')->get();
    }
    public function headings(): array
    {
        return [
            'NAMA PROGRAM STUDI',
            'NAMA MATA KULIAH',
            'KELAS KULIAH',
            'BOBOT SKS',
            'JUMLAH KRS',
            'JUMLAH DOSEN'
        ];
    }
}
