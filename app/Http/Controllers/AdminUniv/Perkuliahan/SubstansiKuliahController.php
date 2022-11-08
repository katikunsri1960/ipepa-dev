<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListSubstansiKuliah;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use Illuminate\Support\Facades\DB;

class SubstansiKuliahController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data =ListSubstansiKuliah::leftJoin('pd_feeder_program_studi','pd_feeder_program_studi.id_prodi','pd_feeder_list_substansi_kuliah.id_prodi');
        $prodi = $data->select('pd_feeder_list_substansi_kuliah.id_prodi', 'pd_feeder_list_substansi_kuliah.nama_program_studi', 'nama_jenjang_pendidikan')->distinct()->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $val = $req;
        // dd($prodi);
        // $data = ListSubstansiKuliah::leftJoin('pd_feeder_jenis_mata_kuliah','pd_feeder_jenis_mata_kuliah.id_jenis_mata_kuliah','pd_feeder_mata_kuliah.id_jenis_mata_kuliah');

        $substansi = $data->select('id_substansi', 'nama_substansi', 'sks_mata_kuliah', 'sks_tatap_muka','sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi', 'pd_feeder_list_substansi_kuliah.id_prodi', 'pd_feeder_list_substansi_kuliah.nama_program_studi')
        ->when($req->has('p') || $req->has('keyword') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_substansi_kuliah.nama_substansi', 'like', '%'.$req->keyword.'%');
                // ->orWhere('pd_feeder_list_substansi_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('pd_feeder_list_substansi_kuliah.id_prodi', $req->prodi);
            }
        })->paginate($req->p != '' ? $req->p : 20);
        // dd($mata_kuliah);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];


        return view('backend.univ.perkuliahan.substansi-kuliah.index', compact('substansi','prodi','paginate', 'valPaginate', 'val'));
    }


    public function detail($id)
    {
        $this->authorize('admin-univ');

        $detail = ListSubstansiKuliah::where('id_substansi',$id)
        ->select('id_substansi', 'nama_substansi', 'sks_mata_kuliah', 'sks_tatap_muka','sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi')
        ->paginate(20);
        return view('backend.univ.perkuliahan.substansi-kuliah.detail', compact('detail'));
    }
}
