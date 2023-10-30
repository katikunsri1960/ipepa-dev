<?php

namespace App\Http\Controllers\AdminUniv\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportController extends Controller
{
    public function daftar_mahasiswa(Request $req)
    {

        $this->authorize('admin-univ');
        if ($req->has('prodi')) {
            dd($req->prodi);
        }
        $rows = [];

        // ListMahasiswa::leftJoin('pd_feeder_semester as semester','id_semester','id_periode')
        //         ->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_mahasiswa as id_mahasiswa',
        //         'pd_feeder_list_mahasiswa.nama_mahasiswa as nama_mahasiswa', 'pd_feeder_list_mahasiswa.nim as nim', 'pd_feeder_list_mahasiswa.jenis_kelamin as jenis_kelamin',
        //         'pd_feeder_list_mahasiswa.nama_agama as nama_agama', 'pd_feeder_list_mahasiswa.total_sks as total_sks', 'pd_feeder_list_mahasiswa.tanggal_lahir as tanggal_lahir',
        //         'pd_feeder_list_mahasiswa.nama_program_studi as nama_program_studi',
        //         'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status_mahasiswa', 'semester.id_tahun_ajaran as angkatan')
        //     // ->addSelect(DB::raw('(SELECT id_tahun_ajaran from pd_feeder_semester as semester where semester.id_semester = pd_feeder_list_mahasiswa.id_periode) as angkatan'))
        //     ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) from transkrip_mahasiswa where id_registrasi_mahasiswa = pd_feeder_list_mahasiswa.id_registrasi_mahasiswa) as total'))
        //     ->orderBy('id_mahasiswa')
        //     ->chunk(2000, function($data) use (&$rows) {
        //     foreach ($data->toArray() as $row) {
        //         $rows[] = $row;
        //     }
        // });

        // SimpleExcelWriter::streamDownload('daftar_mahasiswa.xlsx')
        //     ->noHeaderRow()
        //     ->addRows($rows);
    }
}
