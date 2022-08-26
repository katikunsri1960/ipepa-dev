<?php

namespace App\Http\Controllers\AdminUniv\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PDUnsri\Feeder\Dosen\ListDosen;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;

class PenugasanDosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $dosen =

        $dosen = ListDosen::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nidn', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nip', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('pd_feeder_list_dosen.id_dosen as id_dosen',
         'pd_feeder_list_dosen.nama_dosen as nama_dosen', 'pd_feeder_list_dosen.nidn as nidn', 'pd_feeder_list_dosen.jenis_kelamin as jenis_kelamin',
            'pd_feeder_list_dosen.nama_agama as nama_agama', 'pd_feeder_list_dosen.tanggal_lahir as tanggal_lahir', 'pd_feeder_list_dosen.nama_status_aktif as nama_status_aktif')->paginate(20);

        // dd($mahasiswa);

        return view('backend.univ.dosen.penugasan_dosen.daftar-penugasan-dosen', compact('dosen'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailPenugasanDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        // $aktivitas = AktivitasKuliahMahasiswa::where('id_mahasiswa', $id)->get();
        return view('backend.univ.dosen.penugasan_dosen.detail-daftar-penugasan-dosen', compact('dosen'));
    }
}
