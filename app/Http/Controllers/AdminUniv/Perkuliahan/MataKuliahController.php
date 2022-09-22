<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpMyAdmin\SqlParser\Components\Limit;

class MataKuliahController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $mk =

        $mk = MataKuliah::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_mata_kuliah.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_mata_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah','nama_program_studi', 'id_jenis_mata_kuliah')
        ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
        ->paginate(20);

        return view('backend.univ.perkuliahan.mata-kuliah.index', compact('mk'));
    }

    public function detail_matkul($id)
    {
        $this->authorize('admin-univ');

        $detail_matkul = DetailMataKuliah::where('id_matkul',$id)
                ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', 'id_jenis_mata_kuliah', 'sks_mata_kuliah', 'sks_tatap_muka', 'sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi', 'metode_kuliah', 'tanggal_mulai_efektif', 'tanggal_selesai_efektif' )
                ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_detail_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
                // ->paginate(20)
                ->get();
                // dd($detail_matkul($id));

        return view('backend.univ.perkuliahan.mata-kuliah.detail', compact('detail_matkul'));
    }

}
