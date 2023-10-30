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
        ->addSelect(DB::raw('(SELECT nilai_angka FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_angka'))
        ->addSelect(DB::raw('(SELECT nilai_huruf FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_huruf'))
        ->addSelect(DB::raw('(SELECT nilai_indeks FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_indeks '))
        ->where('krs_mahasiswa.id_prodi', $this->program_studi)
        ->where('krs_mahasiswa.id_periode', $this->semester)->get();

        // $data = DB::raw("SELECT krs_mahasiswa.nim,krs_mahasiswa.nama_mahasiswa,krs_mahasiswa.nama_program_studi,krs_mahasiswa.kode_mata_kuliah,krs_mahasiswa.nama_mata_kuliah,krs_mahasiswa.sks_mata_kuliah,(SELECT riwayat_nilai_mahasiswa.nilai_angka FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_angka,(SELECT riwayat_nilai_mahasiswa.nilai_huruf FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_huruf,(SELECT riwayat_nilai_mahasiswa.nilai_indeks FROM riwayat_nilai_mahasiswa WHERE riwayat_nilai_mahasiswa.id_registrasi_mahasiswa=krs_mahasiswa.id_registrasi_mahasiswa AND riwayat_nilai_mahasiswa.id_matkul=krs_mahasiswa.id_matkul AND riwayat_nilai_mahasiswa.id_kelas=krs_mahasiswa.id_kelas) AS nilai_indeks FROM krs_mahasiswa WHERE krs_mahasiswa.id_periode={$this->semester} AND krs_mahasiswa.id_prodi={$this->program_studi};");

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
