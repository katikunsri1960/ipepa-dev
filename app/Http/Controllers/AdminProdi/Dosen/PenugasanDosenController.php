<?php

namespace App\Http\Controllers\AdminProdi\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListPenugasanDosen;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\RolesUser;

class PenugasanDosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = ListPenugasanDosen::leftJoin('pd_feeder_tahun_ajaran','pd_feeder_tahun_ajaran.id_tahun_ajaran','pd_feeder_list_penugasan_dosen.id_tahun_ajaran')->where('pd_feeder_list_penugasan_dosen.id_prodi', $prodiId);

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('id_prodi', $prodiId)->get();
        $angkatan = $data->select('pd_feeder_tahun_ajaran.nama_tahun_ajaran')->distinct()->orderBy('pd_feeder_tahun_ajaran.nama_tahun_ajaran','DESC')->get();
        $jk = $data->select('jk')->distinct()->get();
        $angkatan_aktif = $angkatan->toArray();
        $val = $req;

        if ($req->has('angkatan')) {
            $dosen = $data->select('*')->orderBy('pd_feeder_list_penugasan_dosen.nama_tahun_ajaran','DESC')
            ->when($req->has('p') || $req->has('keyword') || $req->has('prodi') || $req->has('jk') || $req->has('angkatan'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_penugasan_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_penugasan_dosen.nidn', 'like', '%'.$req->keyword.'%');
            }
            if ($req->angkatan!='') {
                $q->whereIn('pd_feeder_tahun_ajaran.nama_tahun_ajaran', $req->angkatan);
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
            if ($req->jk!='') {
                $q->whereIn('jk', $req->jk);

            }
        })->paginate($req->p != '' ? $req->p : 20);
        } else {

            $dosen = $data->select('*')->orderBy('pd_feeder_list_penugasan_dosen.nama_tahun_ajaran','DESC')->where('pd_feeder_list_penugasan_dosen.nama_tahun_ajaran', $angkatan_aktif[0]['nama_tahun_ajaran'])
            ->when($req->has('p') ||$req->has('keyword') || $req->has('prodi') || $req->has('jk') || $req->has('angkatan'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('pd_feeder_list_penugasan_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_list_penugasan_dosen.nidn', 'like', '%'.$req->keyword.'%');
                }
                if ($req->prodi!='') {
                    $q->whereIn('id_prodi', $req->prodi);
                }
                if ($req->jk!='') {
                    $q->whereIn('jk', $req->jk);

                }
            })->paginate($req->p != '' ? $req->p : 20);
        }

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.prodi.dosen.penugasan_dosen.daftar-penugasan-dosen', compact('dosen','prodi','angkatan','angkatan_aktif','jk','val','paginate', 'valPaginate'));
    }

    public function detail($id,$tahun,$prodi)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailPenugasanDosen::where('id_dosen',$id)->where('id_tahun_ajaran',$tahun)->where('id_prodi',$prodi)->select('*')->first();

        return view('backend.prodi.dosen.penugasan_dosen.detail-daftar-penugasan-dosen', compact('dosen'));
    }
}
