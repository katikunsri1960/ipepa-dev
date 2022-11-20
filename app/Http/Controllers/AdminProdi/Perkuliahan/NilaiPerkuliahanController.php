<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\RolesUser;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListNilaiPerkuliahan;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailNilaiPerkuliahan;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;


class NilaiPerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');
        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();

        $data = new(ListNilaiPerkuliahan::class);

        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $semester_aktif = $semester->toArray();
        $val = $req;

        if ($req->has('semester') || $req->has('prodi'))  {
            $nilai_perkuliahan = $data->select('*')
            ->where('id_sms', $prodiId)
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_nilai_perkuliahan.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%');
            }

            //semester
            if ($req->semester!='') {
                $q->whereIn('nm_smt', $req->semester);
            }

            if ($req->prodi!='') {
                $q->whereIn('id_sms', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        else {
            $nilai_perkuliahan = $data->select('*')
            ->where('id_sms', $prodiId)
            ->where('pd_feeder_list_nilai_perkuliahan.nm_smt', $semester_aktif[0]['nama_semester'])
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_nilai_perkuliahan.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%')
                ;
            }

            if ($req->prodi!='') {
                $q->whereIn('id_sms', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);

        }
        // dd($nilai_perkuliahan);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];
        return view('backend.prodi.perkuliahan.nilai-perkuliahan.index', compact('nilai_perkuliahan','val','prodi',
        'semester', 'semester_aktif','paginate', 'valPaginate'));
    }

    public function detail($id,$semester)
    {
        $this->authorize('admin-prodi');
        // $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();

        $nim = KrsMahasiswa::leftJoin('pd_feeder_list_mahasiswa', 'pd_feeder_list_mahasiswa.id_registrasi_mahasiswa', 'pd_feeder_krs_mahasiswa.id_registrasi_mahasiswa')
                        ->leftJoin('pd_feeder_transkrip_mahasiswa', 'pd_feeder_transkrip_mahasiswa.id_kelas_kuliah', 'pd_feeder_krs_mahasiswa.id_kelas');

        $detail = ListNilaiPerkuliahan::where('id_kelas_kuliah',$id)->where('id_smt',$semester)->select('*')->get();

        $mahasiswa = DetailNilaiPerkuliahan::where('id_kelas_kuliah',$id)
                                    ->where('id_semester',$semester)
                                    ->select('nim','nama_mahasiswa','nama_program_studi','angkatan', 'nilai_indeks', 'nilai_huruf')
                                    ->get();
        // dd($mahasiswa);
        return view('backend.prodi.perkuliahan.nilai-perkuliahan.detail', compact('detail', 'mahasiswa'));
    }

}
