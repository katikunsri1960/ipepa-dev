<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportKRSMahasiswa implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $semester)
    {
        $this->program_studi = $program_studi;
        $this->semester = $semester;
    }
    public function collection()
    {

        $data = KrsMahasiswa::select('nim','nama_mahasiswa','nama_program_studi','kode_mata_kuliah','nama_mata_kuliah','sks_mata_kuliah')
        ->addSelect(DB::raw('(SELECT nilai_angka FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_angka'))
        ->addSelect(DB::raw('(SELECT nilai_huruf FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_huruf'))
        ->addSelect(DB::raw('(SELECT nilai_indeks FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_indeks '))
        ->where('pd_feeder_krs_mahasiswa.id_prodi', $this->program_studi)
        ->where('pd_feeder_krs_mahasiswa.id_periode', $this->semester)->get();

        // $data = DB::raw("SELECT pd_feeder_krs_mahasiswa.nim,pd_feeder_krs_mahasiswa.nama_mahasiswa,pd_feeder_krs_mahasiswa.nama_program_studi,pd_feeder_krs_mahasiswa.kode_mata_kuliah,pd_feeder_krs_mahasiswa.nama_mata_kuliah,pd_feeder_krs_mahasiswa.sks_mata_kuliah,(SELECT pd_feeder_riwayat_nilai_mahasiswa.nilai_angka FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_angka,(SELECT pd_feeder_riwayat_nilai_mahasiswa.nilai_huruf FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_huruf,(SELECT pd_feeder_riwayat_nilai_mahasiswa.nilai_indeks FROM pd_feeder_riwayat_nilai_mahasiswa WHERE pd_feeder_riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa AND pd_feeder_riwayat_nilai_mahasiswa.id_matkul=pd_feeder_krs_mahasiswa.id_matkul AND pd_feeder_riwayat_nilai_mahasiswa.id_kelas=pd_feeder_krs_mahasiswa.id_kelas) AS nilai_indeks FROM pd_feeder_krs_mahasiswa WHERE pd_feeder_krs_mahasiswa.id_periode={$this->semester} AND pd_feeder_krs_mahasiswa.id_prodi={$this->program_studi};");

        return $data;
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'PROGRAM STUDI',
            'KODE MATA KULIAH',
            'NAMA MATA KULIAH',
            'BOBOT MATA KULIAH (SKS)',
            'NILAI ANGKA',
            'NILAI HURUF',
            'NILAI INDEKS'
        ];
    }
}
