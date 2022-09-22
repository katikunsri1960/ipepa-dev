<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKurikulum;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListKurikulum;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\MatkulKurikulum;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurikulumController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = new(ListKurikulum::class);

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->get();
        $val = $req;

        $kurikulum = $data->when($req->has('keyword') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_kurikulum.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_kurikulum.semester_mulai_berlaku', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
        })
        ->select('id_kurikulum', 'id_prodi', 'nama_kurikulum', 'nama_program_studi', 'semester_mulai_berlaku', 'jumlah_sks_lulus','jumlah_sks_wajib', 'jumlah_sks_pilihan','jumlah_sks_mata_kuliah_wajib','jumlah_sks_mata_kuliah_pilihan')
        ->paginate(20);

        return view('backend.univ.perkuliahan.kurikulum.index', compact('kurikulum','prodi','val'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        $data = new(DetailKurikulum::class);

        $data1 = new(MatkulKurikulum::class);

        $detail_kurikulum = $data->where('id_kurikulum',$id)
                ->select('nama_kurikulum', 'nama_program_studi', 'semester_mulai_berlaku', 'jumlah_sks_lulus', 'jumlah_sks_wajib', 'jumlah_sks_pilihan')->get();

        $mata_kuliah_kurikulum = $data1->where('id_kurikulum',$id)
                ->select('kode_mata_kuliah','nama_mata_kuliah','sks_mata_kuliah','sks_tatap_muka','sks_praktek','sks_praktek_lapangan','sks_simulasi','semester','apakah_wajib')->orderBy('semester','ASC')->get();

        $sum_sks_mata_kuliah = $mata_kuliah_kurikulum->sum('sks_mata_kuliah');
        $sum_sks_tatap_muka = $mata_kuliah_kurikulum->sum('sks_tatap_muka');
        $sum_sks_praktek = $mata_kuliah_kurikulum->sum('sks_praktek');
        $sum_sks_praktek_lapangan = $mata_kuliah_kurikulum->sum('sks_praktek_lapangan');
        $sum_sks_simulasi = $mata_kuliah_kurikulum->sum('sks_simulasi');


        return view('backend.univ.perkuliahan.kurikulum.detail', compact('detail_kurikulum','mata_kuliah_kurikulum','sum_sks_mata_kuliah','sum_sks_tatap_muka','sum_sks_praktek','sum_sks_praktek_lapangan','sum_sks_simulasi'));
    }
}
