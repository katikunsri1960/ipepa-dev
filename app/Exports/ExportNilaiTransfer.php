<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\NilaiTransferPendidikan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportNilaiTransfer implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $periode)
    {
        $this->program_studi = $program_studi;
        $this->periode = $periode;
    }
    public function collection()
    {
        $data = NilaiTransferPendidikan::leftJoin('pd_feeder_semester', 'pd_feeder_semester.id_semester', 'pd_feeder_nilai_transfer_pendidikan.id_periode_masuk');

        return $data->select('pd_feeder_nilai_transfer_pendidikan.nim','pd_feeder_nilai_transfer_pendidikan.nama_mahasiswa','pd_feeder_semester.id_tahun_ajaran','pd_feeder_nilai_transfer_pendidikan.nama_program_studi','pd_feeder_nilai_transfer_pendidikan.kode_mata_kuliah_asal','pd_feeder_nilai_transfer_pendidikan.nama_mata_kuliah_asal','pd_feeder_nilai_transfer_pendidikan.sks_mata_kuliah_asal','pd_feeder_nilai_transfer_pendidikan.nilai_huruf_asal','pd_feeder_nilai_transfer_pendidikan.kode_matkul_diakui','pd_feeder_nilai_transfer_pendidikan.nama_mata_kuliah_diakui','pd_feeder_nilai_transfer_pendidikan.sks_mata_kuliah_diakui','pd_feeder_nilai_transfer_pendidikan.nilai_huruf_diakui','pd_feeder_nilai_transfer_pendidikan.nilai_angka_diakui')->where('pd_feeder_nilai_transfer_pendidikan.id_prodi', $this->program_studi)->where('pd_feeder_semester.id_tahun_ajaran', $this->periode)->get();
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'ANGKATAN',
            'PROGRAM STUDI',
            'KODE MATA KULIAH ASAL',
            'NAMA MATA KULIAH ASAL',
            'SKS MATA KULIAH ASAL',
            'NILAI HURUF ASAL',
            'KODE MATA KULIAH DIAKUI',
            'NAMA MATA KULIAH DIAKUI',
            'SKS MATA KULIAH DIAKUI',
            'NILAI HURUF DIAKUI',
            'NILAI ANGKA DIAKUI'
        ];
    }
}
