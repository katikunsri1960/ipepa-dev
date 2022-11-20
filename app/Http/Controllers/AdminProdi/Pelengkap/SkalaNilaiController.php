<?php

namespace App\Http\Controllers\AdminProdi\Pelengkap;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Pelengkap\ListSkalaNilaiProdi;
use App\Models\RolesUser;
use Illuminate\Http\Request;

class SkalaNilaiController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = new(ListSkalaNilaiProdi::class);

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();
        $val = $req;

        $skala_nilai = $data->select('id_bobot_nilai', 'id_prodi', 'nama_program_studi', 'nilai_huruf', 'nilai_indeks', 'bobot_minimum','bobot_maksimum', 'tanggal_mulai_efektif','tanggal_akhir_efektif')->where('pd_feeder_list_skala_nilai_prodi.id_prodi',$prodiId)
        ->orderBy('nilai_huruf')
        ->when($req->has('p') || $req->has('keyword') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_skala_nilai_prodi.nama_program_studi', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
        })->paginate($req->p != '' ? $req->p : 20);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.prodi.pelengkap.skala-nilai.index', compact('skala_nilai','prodi','val','paginate', 'valPaginate'));
    }

    public function detail($id)
    {
        $this->authorize('admin-prodi');

        $data = new(ListSkalaNilaiProdi::class);

        $detail_skala_nilai = $data->where('id_bobot_nilai',$id)
                ->select('nama_program_studi', 'nilai_huruf', 'nilai_indeks', 'bobot_minimum','bobot_maksimum', 'tanggal_mulai_efektif','tanggal_akhir_efektif')->get();


        return view('backend.prodi.pelengkap.skala-nilai.detail', compact('detail_skala_nilai'));
    }
}
