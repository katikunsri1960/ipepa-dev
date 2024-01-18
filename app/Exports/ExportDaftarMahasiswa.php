<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDaftarMahasiswa implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $periode, string $status_mahasiswa)
    {
        $this->status_mahasiswa = $status_mahasiswa;
        $this->program_studi = $program_studi;
        $this->periode = $periode;
    }
    public function collection()
    {
        if($this->status_mahasiswa=='Semua Status Mahasiswa' && $this->program_studi=='Semua Prodi'){
            $data = ListMahasiswa::join('pd_feeder_biodata_mahasiswa', 'pd_feeder_biodata_mahasiswa.id_mahasiswa', 'pd_feeder_list_mahasiswa.id_mahasiswa')->join('pd_feeder_list_riwayat_pendidikan_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa')->leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa.id_periode');

            return $data->select('pd_feeder_list_mahasiswa.nim','pd_feeder_biodata_mahasiswa.nik','pd_feeder_biodata_mahasiswa.nama_mahasiswa','pd_feeder_list_mahasiswa.nama_program_studi','pd_feeder_list_riwayat_pendidikan_mahasiswa.tanggal_daftar','pd_feeder_list_riwayat_pendididkan_mahasiswa.tanggal_keluar','pd_feeder_list_riwayat_pendidikan_mahasiswa.periode_keluar','pd_feeder_list_mahasiswa.nama_status_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.nama_jenis_daftar','pd_feeder_list_riwayat_pendidikan_mahasiswa.biaya_masuk','pd_feeder_list_mahasiswa.jenis_kelamin','pd_feeder_biodata_mahasiswa.tempat_lahir','pd_feeder_biodata_mahasiswa.tanggal_lahir','pd_feeder_biodata_mahasiswa.nama_agama','pd_feeder_biodata_mahasiswa.jalan')->where('pd_feeder_semester.id_tahun_ajaran',$this->periode)->get();
        }
        if($this->status_mahasiswa!='Semua Status Mahasiswa' && $this->program_studi=='Semua Prodi'){
            $data = ListMahasiswa::join('pd_feeder_biodata_mahasiswa', 'pd_feeder_biodata_mahasiswa.id_mahasiswa', 'pd_feeder_list_mahasiswa.id_mahasiswa')->join('pd_feeder_list_riwayat_pendidikan_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa')->leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa.id_periode');

            return $data->select('pd_feeder_list_mahasiswa.nim','pd_feeder_biodata_mahasiswa.nik','pd_feeder_biodata_mahasiswa.nama_mahasiswa','pd_feeder_list_mahasiswa.nama_program_studi','pd_feeder_list_riwayat_pendidikan_mahasiswa.tanggal_daftar','pd_feeder_list_riwayat_pendididkan_mahasiswa.tanggal_keluar','pd_feeder_list_riwayat_pendidikan_mahasiswa.periode_keluar','pd_feeder_list_mahasiswa.nama_status_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.nama_jenis_daftar','pd_feeder_list_riwayat_pendidikan_mahasiswa.biaya_masuk','pd_feeder_list_mahasiswa.jenis_kelamin','pd_feeder_biodata_mahasiswa.tempat_lahir','pd_feeder_biodata_mahasiswa.tanggal_lahir','pd_feeder_biodata_mahasiswa.nama_agama','pd_feeder_biodata_mahasiswa.jalan')->where('pd_feeder_semester.id_tahun_ajaran',$this->periode)->where('pd_feeder_list_mahasiswa.nama_status_mahasiswa',$this->status_mahasiswa)->get();
        }
        if($this->status_mahasiswa=='Semua Status Mahasiswa' && $this->program_studi!='Semua Prodi'){
            $data = ListMahasiswa::join('pd_feeder_biodata_mahasiswa', 'pd_feeder_biodata_mahasiswa.id_mahasiswa', 'pd_feeder_list_mahasiswa.id_mahasiswa')->join('pd_feeder_list_riwayat_pendidikan_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa')->leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa.id_periode');

            return $data->select('pd_feeder_list_mahasiswa.nim','pd_feeder_biodata_mahasiswa.nik','pd_feeder_biodata_mahasiswa.nama_mahasiswa','pd_feeder_list_mahasiswa.nama_program_studi','pd_feeder_list_riwayat_pendidikan_mahasiswa.tanggal_daftar','pd_feeder_list_riwayat_pendididkan_mahasiswa.tanggal_keluar','pd_feeder_list_riwayat_pendidikan_mahasiswa.periode_keluar','pd_feeder_list_mahasiswa.nama_status_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.nama_jenis_daftar','pd_feeder_list_riwayat_pendidikan_mahasiswa.biaya_masuk','pd_feeder_list_mahasiswa.jenis_kelamin','pd_feeder_biodata_mahasiswa.tempat_lahir','pd_feeder_biodata_mahasiswa.tanggal_lahir','pd_feeder_biodata_mahasiswa.nama_agama','pd_feeder_biodata_mahasiswa.jalan')->where('pd_feeder_semester.id_tahun_ajaran',$this->periode)->where('pd_feeder_list_mahasiswa.id_prodi',$this->program_studi)->get();
        }else{
            $data = ListMahasiswa::join('pd_feeder_biodata_mahasiswa', 'pd_feeder_biodata_mahasiswa.id_mahasiswa', 'pd_feeder_list_mahasiswa.id_mahasiswa')->join('pd_feeder_list_riwayat_pendidikan_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa')->leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa.id_periode');

            return $data->select('pd_feeder_list_mahasiswa.nim','pd_feeder_biodata_mahasiswa.nik','pd_feeder_biodata_mahasiswa.nama_mahasiswa','pd_feeder_list_mahasiswa.nama_program_studi','pd_feeder_list_riwayat_pendidikan_mahasiswa.tanggal_daftar','pd_feeder_list_riwayat_pendididkan_mahasiswa.tanggal_keluar','pd_feeder_list_riwayat_pendidikan_mahasiswa.periode_keluar','pd_feeder_list_mahasiswa.nama_status_mahasiswa','pd_feeder_list_riwayat_pendidikan_mahasiswa.nama_jenis_daftar','pd_feeder_list_riwayat_pendidikan_mahasiswa.biaya_masuk','pd_feeder_list_mahasiswa.jenis_kelamin','pd_feeder_biodata_mahasiswa.tempat_lahir','pd_feeder_biodata_mahasiswa.tanggal_lahir','pd_feeder_biodata_mahasiswa.nama_agama','pd_feeder_biodata_mahasiswa.jalan')->where('pd_feeder_semester.id_tahun_ajaran',$this->periode)->where('pd_feeder_list_mahasiswa.id_prodi',$this->program_studi)->where('pd_feeder_list_mahasiswa.nama_status_mahasiswa',$this->status_mahasiswa)->get();
        }
    }
    public function headings(): array
    {
        return [
            'NIM',
            'NIK',
            'NAMA MAHASISWA',
            'NAMA PROGRAM STUDI',
            'TANGGAL MASUK',
            'TANGGAL KELUAR',
            'NAMA PERIODE KELUAR',
            'STATUS MAHASISWA',
            'JENIS DAFTAR',
            'BIAYA MASUK',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AGAMA',
            'ALAMAT'
        ];
    }
}
