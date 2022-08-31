<?php

namespace App\Http\Controllers\AdminProdi\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListPenugasanDosen;

class PenugasanDosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $dosen =

        $dosen = ListPenugasanDosen::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_penugasan_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_penugasan_dosen.nidn', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('*')->orderBy('id_tahun_ajaran','DESC')->paginate(20);

        // dd($mahasiswa);

        return view('backend.prodi.dosen.penugasan_dosen.daftar-penugasan-dosen', compact('dosen'));
    }

    public function detail($id,$tahun,$prodi)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailPenugasanDosen::where('id_dosen',$id)->where('id_tahun_ajaran',$tahun)->where('id_prodi',$prodi)->select('*')->first();

        return view('backend.prodi.dosen.penugasan_dosen.detail-daftar-penugasan-dosen', compact('dosen'));
    }
}
