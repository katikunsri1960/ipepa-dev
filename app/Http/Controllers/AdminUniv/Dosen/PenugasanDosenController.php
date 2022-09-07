<?php

namespace App\Http\Controllers\AdminUniv\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListPenugasanDosen;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Symfony\Component\Console\Helper\ProgressBar;

class PenugasanDosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = ListPenugasanDosen::leftJoin('pd_feeder_tahun_ajaran','pd_feeder_tahun_ajaran.id_tahun_ajaran','pd_feeder_list_penugasan_dosen.id_tahun_ajaran');;

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->get();
        $angkatan = TahunAjaran::select('nama_tahun_ajaran')->orderBy('nama_tahun_ajaran','DESC')->get();
        $jk = $data->select('jk')->distinct()->get();
        $angkatan_aktif = $angkatan->toArray();
        $val = $req;

        $dosen = $data->when($req->has('keyword') || $req->has('prodi') || $req->has('jk') || $req->has('angkatan'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_penugasan_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_penugasan_dosen.nidn', 'like', '%'.$req->keyword.'%');
            }
            if ($req->angkatan!='') {
                $q->whereIn('pd_feeder_tahun_ajaran.nama_tahun_ajaran', $req->angkatan);
            }
            if ($req->angkatan='') {
                $q->whereIn('pd_feeder_tahun_ajaran.nama_tahun_ajaran', $req->angkatan_aktif[0]);
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
            if ($req->jk!='') {
                $q->whereIn('jk', $req->jk);

            }
        })
        ->select('*')->orderBy('pd_feeder_list_penugasan_dosen.nama_tahun_ajaran','DESC')->paginate(20);

        // dd($mahasiswa);

        return view('backend.univ.dosen.penugasan_dosen.daftar-penugasan-dosen', compact('dosen','prodi','angkatan','angkatan_aktif','jk','val'));
    }

    public function detail($id,$tahun,$prodi)
    {
        $this->authorize('admin-univ');

        $dosen = DetailPenugasanDosen::where('id_dosen',$id)->where('id_tahun_ajaran',$tahun)->where('id_prodi',$prodi)->select('*')->first();

        return view('backend.univ.dosen.penugasan_dosen.detail-daftar-penugasan-dosen', compact('dosen'));
    }
}
