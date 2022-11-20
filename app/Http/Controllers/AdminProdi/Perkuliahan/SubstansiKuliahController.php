<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\RolesUser;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListSubstansiKuliah;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use Illuminate\Support\Facades\DB;

class SubstansiKuliahController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data =ListSubstansiKuliah::leftJoin('pd_feeder_program_studi','pd_feeder_program_studi.id_prodi','pd_feeder_list_substansi_kuliah.id_prodi');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();
        $val = $req;
        // dd($prodi);


        $substansi = $data->select('id_substansi', 'nama_substansi', 'sks_mata_kuliah', 'sks_tatap_muka','sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi', 'pd_feeder_list_substansi_kuliah.id_prodi', 'pd_feeder_list_substansi_kuliah.nama_program_studi')
        ->where('pd_feeder_list_substansi_kuliah.id_prodi', $prodiId)
        ->when($req->has('p') || $req->has('keyword') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_substansi_kuliah.nama_substansi', 'like', '%'.$req->keyword.'%');
                // ->orWhere('pd_feeder_list_substansi_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('pd_feeder_list_substansi_kuliah.id_prodi', $req->prodi);
            }
        })->paginate($req->p != '' ? $req->p : 20);
        // dd($substansi);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];


        return view('backend.prodi.perkuliahan.substansi-kuliah.index', compact('substansi','prodi','paginate', 'valPaginate', 'val'));
    }


    public function detail($id)
    {
        $this->authorize('admin-prodi');

        $detail = ListSubstansiKuliah::where('id_substansi',$id)
        ->select('id_substansi','nama_program_studi', 'nama_substansi', 'sks_mata_kuliah', 'sks_tatap_muka','sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi')
        ->paginate(20);
        return view('backend.prodi.perkuliahan.substansi-kuliah.detail', compact('detail'));
    }
}
