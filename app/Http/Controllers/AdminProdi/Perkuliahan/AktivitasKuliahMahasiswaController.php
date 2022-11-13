<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\StatusMahasiswa;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Illuminate\Support\Facades\DB;
use App\Models\RolesUser;


class AktivitasKuliahMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = new(AktivitasKuliahMahasiswa::class);
        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('id_prodi',$prodiId)->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $semester_aktif = $semester->toArray();
        $angkatan = Semester::select('pd_feeder_semester.id_tahun_ajaran')->distinct()->orderBy('pd_feeder_semester.id_tahun_ajaran','DESC')->get();
        $val = $req;
        $status_mahasiswa = StatusMahasiswa::select('id_status_mahasiswa', 'nama_status_mahasiswa')->get();

        if ($req->has('semester') || $req->has('prodi'))  {
            $aktivitas_kuliah_mahasiswa = $data->select('*')
            ->where('id_prodi', $prodiId)
            ->orderBy('nama_mahasiswa')
            // ->orderBy('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester','DESC')
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi')  || $req->has('angkatan') || $req->has('status_mahasiswa'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_aktivitas_kuliah_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ;
            }

            //semester
            if ($req->semester!='') {
                $q->whereIn('nama_semester', $req->semester);
            }
            // if ($req->semester='') {
            //     $q->whereIn('nama_semester', $req->semester_aktif[0]);
            // }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            if ($req->angkatan!='') {
                $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan);
            }
            // if ($req->angkatan='') {
            //     $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan_aktif[0]);
            // }
            if ($req->status_mahasiswa!='') {
                $q->whereIn('nama_status_mahasiswa', $req->status_mahasiswa);
            }


            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        else {
            $aktivitas_kuliah_mahasiswa = $data->select('*')
            // ->orderBy('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester','DESC')
            ->where('id_prodi', $prodiId)
            ->where('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester', $semester_aktif[0]['nama_semester'])
            ->orderBy('nama_mahasiswa')
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi')  || $req->has('angkatan') || $req->has('status_mahasiswa'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_aktivitas_kuliah_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ;
            }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            if ($req->angkatan!='') {
                $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan);
            }

            if ($req->status_mahasiswa!='') {
                $q->whereIn('nama_status_mahasiswa', $req->status_mahasiswa);
            }


            })
            ->paginate($req->p != '' ? $req->p : 20);

        }


        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];
        return view('backend.prodi.perkuliahan.aktivitas-kuliah-mahasiswa.index', compact('aktivitas_kuliah_mahasiswa','val','prodi',
        'semester', 'semester_aktif','angkatan' ,'status_mahasiswa' ,'paginate', 'valPaginate'));
        // 'angkatan_aktif',

    }



    public function detail($id,$semester)
    {
        $this->authorize('admin-prodi');

        $detail = AktivitasKuliahMahasiswa::where('id_mahasiswa',$id)->where('id_semester',$semester)->select('*')->get();

        // dd($detail);
        return view('backend.prodi.perkuliahan.aktivitas-kuliah-mahasiswa.detail', compact('detail'));
    }

}
