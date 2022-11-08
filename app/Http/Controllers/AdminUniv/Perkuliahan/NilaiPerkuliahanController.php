<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListNilaiPerkuliahan;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use Illuminate\Support\Facades\DB;

class NilaiPerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        // $data = new(ListNilaiPerkuliahan::class);

        $data = ListNilaiPerkuliahan::leftJoin('pd_feeder_mata_kuliah','pd_feeder_mata_kuliah.id_matkul','pd_feeder_list_nilai_perkuliahan.id_matkul');
        // dd($data);
        $prodi = ProgramStudi::select('id_prodi','nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $semester_aktif = $semester->toArray();
        $val = $req;

        if ($req->has('semester') || $req->has('prodi'))  {
            $nilai_perkuliahan = $data->select('*')

            // ->orderBy('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester','DESC')
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_nilai_perkuliahan.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%')

                ;

            }

            //semester
            if ($req->semester!='') {
                $q->whereIn('nm_smt', $req->semester);
            }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        else {
            $nilai_perkuliahan = $data->select('*')
            ->where('pd_feeder_list_nilai_perkuliahan.nm_smt', $semester_aktif[0]['nama_semester'])
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_nilai_perkuliahan.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_nilai_perkuliahan.nama_kelas_kuliah', 'like', '%'.$req->keyword.'%')
                ;
            }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];
        return view('backend.univ.perkuliahan.nilai-perkuliahan.index', compact('nilai_perkuliahan','val','prodi',
        'semester', 'semester_aktif','paginate', 'valPaginate'));
        // 'angkatan_aktif',

    }



    public function detail($id,$semester)
    {
        $this->authorize('admin-univ');

        $detail = ListNilaiPerkuliahan::where('id_kelas_kuliah',$id)->where('id_smt',$semester)->select('*')->get();
        // dd($detail);
        return view('backend.univ.perkuliahan.nilai-perkuliahan.detail', compact('detail'));
    }

}
