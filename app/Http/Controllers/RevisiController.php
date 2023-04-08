<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpMyAdmin\Setup\Index;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKelasKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListNilaiPerkuliahan;
use App\Models\PDUnsri\Feeder\Dosen\DosenPengajarKelasKuliah as DPKK;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use Illuminate\Support\Facades\DB;

class RevisiController extends Controller
{

    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = DetailKelasKuliah::leftJoin('pd_feeder_mata_kuliah','pd_feeder_mata_kuliah.id_matkul','pd_feeder_detail_kelas_kuliah.id_matkul')
        ->leftJoin('pd_feeder_program_studi','pd_feeder_program_studi.id_prodi','pd_feeder_detail_kelas_kuliah.id_prodi');

        $prodi = ProgramStudi::select('id_prodi','nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $semester_aktif = $semester->toArray();
        $val = $req;

        if ($req->has('semester')|| $req->has('prodi'))  {
            $kelas_perkuliahan = $data->select('pd_feeder_detail_kelas_kuliah.id_matkul','pd_feeder_detail_kelas_kuliah.id_semester','pd_feeder_detail_kelas_kuliah.nama_semester','pd_feeder_detail_kelas_kuliah.kode_mata_kuliah','pd_feeder_detail_kelas_kuliah.nama_mata_kuliah','pd_feeder_detail_kelas_kuliah.id_kelas_kuliah','pd_feeder_detail_kelas_kuliah.nama_kelas_kuliah','pd_feeder_mata_kuliah.sks_mata_kuliah')
            ->addSelect(DB::raw('(SELECT GROUP_CONCAT(pd_feeder_dosen_pengajar_kelas_kuliah.nama_dosen SEPARATOR ", ") FROM pd_feeder_dosen_pengajar_kelas_kuliah WHERE pd_feeder_detail_kelas_kuliah.id_kelas_kuliah=pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah AND pd_feeder_detail_kelas_kuliah.id_semester=pd_feeder_dosen_pengajar_kelas_kuliah.id_semester) AS nama_dosen'))
            ->addSelect(DB::raw('(SELECT COUNT(id_registrasi_mahasiswa) FROM `pd_feeder_krs_mahasiswa` WHERE pd_feeder_krs_mahasiswa.id_matkul=pd_feeder_detail_kelas_kuliah.id_matkul AND pd_feeder_krs_mahasiswa.id_kelas=pd_feeder_detail_kelas_kuliah.id_kelas_kuliah) AS jumlah_mahasiswa'))
            // ->orderBy ('nama_semester')
            ->when($req->has('p') || $req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('pd_feeder_detail_kelas_kuliah.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_detail_kelas_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_detail_kelas_kuliah.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%');
                }
                //semester
                if ($req->semester!='') {
                    $q->whereIn('nama_semester', $req->semester);
                }
                if ($req->prodi!='') {
                    $q->whereIn('pd_feeder_program_studi.id_prodi', $req->prodi);
                }
            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        else {
            $kelas_perkuliahan = $data->select('pd_feeder_detail_kelas_kuliah.id_matkul','pd_feeder_detail_kelas_kuliah.id_semester','pd_feeder_detail_kelas_kuliah.nama_semester','pd_feeder_detail_kelas_kuliah.kode_mata_kuliah','pd_feeder_detail_kelas_kuliah.nama_mata_kuliah','pd_feeder_detail_kelas_kuliah.id_kelas_kuliah','pd_feeder_detail_kelas_kuliah.nama_kelas_kuliah','pd_feeder_mata_kuliah.sks_mata_kuliah')
            ->addSelect(DB::raw('(SELECT GROUP_CONCAT(pd_feeder_dosen_pengajar_kelas_kuliah.nama_dosen SEPARATOR ", ") FROM pd_feeder_dosen_pengajar_kelas_kuliah WHERE pd_feeder_detail_kelas_kuliah.id_kelas_kuliah=pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah AND pd_feeder_detail_kelas_kuliah.id_semester=pd_feeder_dosen_pengajar_kelas_kuliah.id_semester) AS nama_dosen'))
            ->addSelect(DB::raw('(SELECT COUNT(id_registrasi_mahasiswa) FROM `pd_feeder_krs_mahasiswa` WHERE pd_feeder_krs_mahasiswa.id_matkul=pd_feeder_detail_kelas_kuliah.id_matkul AND pd_feeder_krs_mahasiswa.id_kelas=pd_feeder_detail_kelas_kuliah.id_kelas_kuliah) AS jumlah_mahasiswa'))
            // ->where('pd_feeder_detail_kelas_kuliah.nama_semester', $semester_aktif[0]['nama_semester'])
            // ->orderBy ('nama_semester')
            ->when($req->has('p') || $req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('pd_feeder_detail_kelas_kuliah.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_detail_kelas_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                    ->orWhere('pd_feeder_detail_kelas_kuliah.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%');
                }
                if ($req->prodi!='') {
                    $q->whereIn('pd_feeder_program_studi.id_prodi', $req->prodi);
                }
            })
            ->where('pd_feeder_detail_kelas_kuliah.nama_semester', $semester_aktif[0]['nama_semester'])
            ->paginate($req->p != '' ? $req->p : 20);
            

        }

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.univ.perkuliahan.kelas-perkuliahan.index-rev', compact('keyword','kelas_perkuliahan','val','prodi', 'semester', 'semester_aktif','paginate', 'valPaginate'));
    }
}
