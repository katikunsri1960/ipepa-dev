<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListMahasiswaLulusDo;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\JenisKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaLulusDoController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa_lulus_do.id_periode_keluar');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->get();
        $jenis_keluar = JenisKeluar::select('jenis_keluar as nama_jenis_keluar')->where('apa_mahasiswa', 0)->get();
        $angkatan = $data->select('angkatan')->distinct()->get();
        $tahun_keluar = $data->select('id_tahun_ajaran as tahun_keluar')->distinct()->get();
        $val = $req;

        $mahasiswa_lulus_do = $data->when($req->has('keyword') || $req->has('angkatan') || $req->has('prodi') || $req->has('jenis_keluar') || $req->has('tahun_keluar'), function($q) use($req){
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
                $q->whereIn('pd_feeder_semester.id_tahun_ajaran', $req->tahun_keluar);

            }
        })
        ->select('id_mahasiswa','id_prodi','pd_feeder_semester.id_tahun_ajaran','nim', 'nama_mahasiswa', 'angkatan', 'nama_jenis_keluar','tanggal_keluar', 'pd_feeder_semester.nama_semester','keterangan')
        ->addSelect(DB::raw('(SELECT CONCAT(nama_jenjang_pendidikan," ",nama_program_studi) FROM pd_feeder_program_studi WHERE pd_feeder_program_studi.id_prodi = pd_feeder_list_mahasiswa_lulus_do.id_prodi) as nama_program_studi'))
        // ->orderBy('nama_program_studi')
        ->paginate(20);

        return view('backend.univ.perkuliahan.mahasiswa-lulus-do.index', compact('mahasiswa_lulus_do','prodi','angkatan','jenis_keluar','tahun_keluar','val'));
    }

    public function detail($id,$tahun)
    {
        $this->authorize('admin-univ');

        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester as semester','id_semester','id_periode_keluar');

        $detail_mahasiswa_lulus_do = $data->where('id_mahasiswa',$id)->where('angkatan',$tahun)
                ->select('nim', 'nama_mahasiswa', 'nama_program_studi', 'nama_jenis_keluar', 'tanggal_keluar', 'semester.nama_semester', 'tgl_sk_yudisium', 'sk_yudisium', 'ipk', 'keterangan', 'no_seri_ijazah')->get();

        return view('backend.univ.perkuliahan.mahasiswa-lulus-do.detail', compact('detail_mahasiswa_lulus_do'));
    }
}
