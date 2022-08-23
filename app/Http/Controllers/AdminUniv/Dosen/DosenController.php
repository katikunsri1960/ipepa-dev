<?php

namespace App\Http\Controllers\AdminUniv\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Dosen\ListDosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $mahasiswa =

        $mahasiswa = ListDosen::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_mahasiswa as id_mahasiswa',
         'pd_feeder_list_mahasiswa.nama_mahasiswa as nama_mahasiswa', 'pd_feeder_list_mahasiswa.nim as nim', 'pd_feeder_list_mahasiswa.jenis_kelamin as jenis_kelamin',
            'pd_feeder_list_mahasiswa.nama_agama as nama_agama', 'pd_feeder_list_mahasiswa.total_sks as total_sks', 'pd_feeder_list_mahasiswa.tanggal_lahir as tanggal_lahir',
            'pd_feeder_list_mahasiswa.nama_program_studi as nama_program_studi',
            'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status_mahasiswa', 'pd_feeder_list_mahasiswa.id_periode as id_periode')
        ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) from pd_feeder_transkrip_mahasiswa where id_registrasi_mahasiswa = pd_feeder_list_mahasiswa.id_registrasi_mahasiswa) as total'))
        ->paginate(20);

        // dd($mahasiswa);

        return view('backend.univ.mahasiswa.index', compact('mahasiswa'));
    }
}
