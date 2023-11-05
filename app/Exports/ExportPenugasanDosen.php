<?php

namespace App\Exports;

use App\Models\PDUnsri\Feeder\Dosen\ListPenugasanDosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPenugasanDosen implements FromCollection, WithHeadings
{
    public function __construct(string $program_studi, string $periode)
    {
        $this->program_studi = $program_studi;
        $this->periode = $periode;
    }
    public function collection()
    {
        if($this->program_studi=='Semua Prodi'){
            $data = ListPenugasanDosen::leftJoin('pd_feeder_detail_biodata_dosen', 'pd_feeder_detail_biodata_dosen.id_dosen', 'pd_feeder_list_penugasan_dosen.id_dosen');

            return $data->select('pd_feeder_list_penugasan_dosen.nidn','pd_feeder_list_penugasan_dosen.nama_dosen','pd_feeder_list_penugasan_dosen.nama_program_studi','pd_feeder_list_penugasan_dosen.jk','pd_feeder_detail_biodata_dosen.tempat_lahir','pd_feeder_detail_biodata_dosen.tanggal_lahir','pd_feeder_detail_biodata_dosen.nama_agama')->where('pd_feeder_list_penugasan_dosen.id_tahun_ajaran', $this->periode)->get();
        }else{
            $data = ListPenugasanDosen::leftJoin('pd_feeder_detail_biodata_dosen', 'pd_feeder_detail_biodata_dosen.id_dosen', 'pd_feeder_list_penugasan_dosen.id_dosen');

            return $data->select('pd_feeder_list_penugasan_dosen.nidn','pd_feeder_list_penugasan_dosen.nama_dosen','pd_feeder_list_penugasan_dosen.nama_program_studi','pd_feeder_list_penugasan_dosen.jk','pd_feeder_detail_biodata_dosen.tempat_lahir','pd_feeder_detail_biodata_dosen.tanggal_lahir','pd_feeder_detail_biodata_dosen.nama_agama')->where('pd_feeder_list_penugasan_dosen.id_prodi', $this->program_studi)->where('pd_feeder_list_penugasan_dosen.id_tahun_ajaran', $this->periode)->get();
        }
    }
    public function headings(): array
    {
        return [
            'NIDN',
            'NAMA DOSEN',
            'PROGRAM STUDI',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AGAMA'
        ];
    }
}
