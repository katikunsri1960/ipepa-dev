<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Mahasiswa\ListMahasiswaLulusDo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportMahasiswaLulusDO implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $periode)
    {
        $this->program_studi = $program_studi;
        $this->periode = $periode;
    }
    public function collection()
    {
        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_list_riwayat_pendidikan_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.id_mahasiswa','pd_feeder_list_mahasiswa_lulus_do.id_mahasiswa');

        return $data->select('pd_feeder_list_mahasiswa_lulus_do.nim','pd_feeder_list_mahasiswa_lulus_do.nama_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.nama_program_studi','pd_feeder_list_riwayat_pendidikan_mahasiswa.jenis_kelamin','pd_feeder_list_mahasiswa_lulus_do.nama_jenis_keluar','pd_feeder_list_mahasiswa_lulus_do.tgl_keluar','pd_feeder_list_mahasiswa_lulus_do.no_seri_ijazah','pd_feeder_list_mahasiswa_lulus_do.keterangan')->where('pd_feeder_list_mahasiswa_lulus_do.angkatan',$this->periode)->where('pd_feeder_list_mahasiswa_lulus_do.id_prodi',$this->program_studi)->get();
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'NAMA PROGRAM STUDI',
            'JENIS KELAMIN',
            'STATUS',
            'TANGGAL KELUAR',
            'NOMOR IJAZAH',
            'KETERANGAN'
        ];
    }
}
