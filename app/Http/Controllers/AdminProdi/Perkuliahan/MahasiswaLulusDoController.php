<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\JenisKeluar;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListMahasiswaLulusDo;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaLulusDoController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa_lulus_do.id_periode_keluar')->where('pd_feeder_list_mahasiswa_lulus_do.id_prodi',$prodiId);

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();
        $jenis_keluar = JenisKeluar::select('jenis_keluar as nama_jenis_keluar')->where('apa_mahasiswa', 1)->get();
        $angkatan = TahunAjaran::select('id_tahun_ajaran')->orderBy('id_tahun_ajaran','DESC')->get();
        $tahun_keluar = $data->select(DB::raw('YEAR(tanggal_keluar) as tahun_keluar'))->distinct()->orderBy('tanggal_keluar', 'DESC')->get();
        $tahun_keluar_aktif = $tahun_keluar->toArray();
        $val = $req;

        // $semester_now = Semester::select('pd_feeder_semester.id_tahun_ajaran', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $tahun_keluar->max('tahun_keluar');
        // $tahun_keluar= $data->select('id_tahun_ajaran', 'id_semester')
        // ->addSelect(DB::raw('YEAR(tanggal_keluar) as tahun_keluar'))->distinct()
        // ->orderBy('tanggal_keluar', 'DESC')
        // ->where('id_tahun_ajaran', '<=', $now )->get();
        $semester_aktif = $tahun_keluar->toArray();
        $angkatan = Semester::select('pd_feeder_semester.id_tahun_ajaran')->distinct()->orderBy('pd_feeder_semester.id_tahun_ajaran','DESC')->get();
        // dd($tahun_keluar);



        if ($req->has('angkatan') || $req->has('prodi') || $req->has('tahun_keluar') || $req->has('jenis_keluar')) {
            $mahasiswa_lulus_do = $data->select('id_mahasiswa','id_prodi','pd_feeder_semester.id_tahun_ajaran','nim', 'nama_mahasiswa', 'angkatan', 'nama_jenis_keluar','tanggal_keluar', 'pd_feeder_semester.nama_semester','keterangan')
            ->addSelect(DB::raw('(SELECT CONCAT(nama_jenjang_pendidikan," ",nama_program_studi) FROM pd_feeder_program_studi WHERE pd_feeder_program_studi.id_prodi = pd_feeder_list_mahasiswa_lulus_do.id_prodi) as nama_program_studi'))
            ->where('id_prodi', $prodiId)
            ->when($req->has('keyword') || $req->has('angkatan') || $req->has('prodi') || $req->has('jenis_keluar') || $req->has('tahun_keluar'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('pd_feeder_list_mahasiswa_lulus_do.nim', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_list_mahasiswa_lulus_do.no_seri_ijazah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_list_mahasiswa_lulus_do.nama_mahasiswa', 'like', '%'.$req->keyword.'%');
                }
                if ($req->angkatan!='') {
                    $q->whereIn('angkatan', $req->angkatan);
                }
                if ($req->prodi!='') {
                    $q->whereIn('id_prodi', $req->prodi);
                }
                if ($req->jenis_keluar!='') {
                    $q->whereIn('nama_jenis_keluar', $req->jenis_keluar);
                }
                if ($req->tahun_keluar!='') {
                    $q->whereIn(DB::raw('YEAR(tanggal_keluar)'),$req->tahun_keluar);
                }
            })
            ->paginate($req->p != '' ? $req->p : 20);
        }

        else {
            $mahasiswa_lulus_do = $data->select('id_mahasiswa','id_prodi','pd_feeder_semester.id_tahun_ajaran','nim', 'nama_mahasiswa', 'angkatan', 'nama_jenis_keluar','tanggal_keluar', 'pd_feeder_semester.nama_semester','keterangan')
            ->addSelect(DB::raw('(SELECT CONCAT(nama_jenjang_pendidikan," ",nama_program_studi) FROM pd_feeder_program_studi WHERE pd_feeder_program_studi.id_prodi = pd_feeder_list_mahasiswa_lulus_do.id_prodi) as nama_program_studi'))
            ->where('id_prodi', $prodiId)
            ->where(DB::raw('YEAR(tanggal_keluar)'), $tahun_keluar_aktif[0]['tahun_keluar'])
            ->when($req->has('keyword') || $req->has('angkatan') || $req->has('prodi') || $req->has('jenis_keluar') || $req->has('tahun_keluar'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('pd_feeder_list_mahasiswa_lulus_do.nim', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_list_mahasiswa_lulus_do.no_seri_ijazah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_list_mahasiswa_lulus_do.nama_mahasiswa', 'like', '%'.$req->keyword.'%');
                }
                if ($req->angkatan!='') {
                    $q->whereIn('angkatan', $req->angkatan);
                }
                if ($req->prodi!='') {
                    $q->whereIn('id_prodi', $req->prodi);
                }
                if ($req->jenis_keluar!='') {
                    $q->whereIn('nama_jenis_keluar', $req->jenis_keluar);
                }
                if ($req->tahun_keluar!='') {
                    $q->whereIn(DB::raw('YEAR(tanggal_keluar)'),$req->tahun_keluar);
                }
            })
            ->paginate($req->p != '' ? $req->p : 20);
        }

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.prodi.perkuliahan.mahasiswa-lulus-do.index', compact('mahasiswa_lulus_do','prodi','angkatan','jenis_keluar','tahun_keluar','tahun_keluar_aktif', 'semester_aktif','angkatan','paginate', 'valPaginate','val'));
    }

    public function detail($id,$tahun)
    {
        $this->authorize('admin-prodi');

        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester as semester','id_semester','id_periode_keluar');

        $detail_mahasiswa_lulus_do = $data->where('id_mahasiswa',$id)->where('angkatan',$tahun)
                ->select('nim', 'nama_mahasiswa', 'nama_program_studi', 'nama_jenis_keluar', 'tanggal_keluar', 'semester.nama_semester', 'tgl_sk_yudisium', 'sk_yudisium', 'ipk', 'keterangan', 'no_seri_ijazah')->get();

        return view('backend.prodi.perkuliahan.mahasiswa-lulus-do.detail', compact('detail_mahasiswa_lulus_do'));
    }
}
