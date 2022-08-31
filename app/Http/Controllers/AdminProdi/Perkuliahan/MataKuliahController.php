<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolesUser;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah as DMK;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    public function index()
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $mk = MataKuliah::where('id_prodi', $prodiId)
                ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah','nama_program_studi', 'id_jenis_mata_kuliah')
                ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
                ->get();

        return view('backend.prodi.perkuliahan.mata-kuliah.index', compact('mk'));
        // dd($mk);
    }

    public function detail($id)
    {
        $this->authorize('admin-prodi');
        $detail = DMK::where('id_matkul', $id)
                ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', 'sks_mata_kuliah', 'sks_tatap_muka', 'sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi',
                        'metode_kuliah', 'tanggal_mulai_efektif', 'tanggal_selesai_efektif')
                ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_detail_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
                ->get();
                // dd($detail);
        // $detail = MataKuliah::where('id_matkul', $id)
        //             ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', '')
        //             ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
        return view('backend.prodi.perkuliahan.mata-kuliah.detail', compact('detail'));
    }
}
