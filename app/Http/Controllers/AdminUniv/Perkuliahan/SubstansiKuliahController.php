<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListSubstansiKuliah;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use Illuminate\Support\Facades\DB;

class SubstansiKuliahController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $substansi =

        $substansi = ListSubstansiKuliah::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_substansi_kuliah.nama_substansi', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('id_substansi', 'nama_substansi', 'sks_mata_kuliah', 'sks_tatap_muka','sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi')
        // ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
        ->paginate(20);
        return view('backend.univ.perkuliahan.substansi-kuliah.index', compact('substansi'));
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
