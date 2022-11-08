<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\StatusMahasiswa;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Illuminate\Support\Facades\DB;

class CekTranskripMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = new(AktivitasKuliahMahasiswa::class);

        // if ($req->has('semester') || $req->has('prodi'))  {
        //     $aktivitas_kuliah_mahasiswa = $data->select('*')
        //     // ->orderBy('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester','DESC')
        //     ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi')  || $req->has('angkatan') || $req->has('status_mahasiswa'), function($q) use($req){
        //     if ($req->keyword != '') {
        //         $q->where('pd_feeder_aktivitas_kuliah_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
        //         ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
        //         ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
        //         ;
        //     }

        //     //semester
        //     if ($req->semester!='') {
        //         $q->whereIn('nama_semester', $req->semester);
        //     }
        //     // if ($req->semester='') {
        //     //     $q->whereIn('nama_semester', $req->semester_aktif[0]);
        //     // }

        //     if ($req->prodi!='') {
        //         $q->whereIn('id_prodi', $req->prodi);
        //     }

        //     if ($req->angkatan!='') {
        //         $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan);
        //     }
        //     // if ($req->angkatan='') {
        //     //     $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan_aktif[0]);
        //     // }
        //     if ($req->status_mahasiswa!='') {
        //         $q->whereIn('nama_status_mahasiswa', $req->status_mahasiswa);
        //     }


        //     })
        //     ->paginate($req->p != '' ? $req->p : 20);

        // }

        // else {
        //     $aktivitas_kuliah_mahasiswa = $data->select('*')
        //     // ->orderBy('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester','DESC')
        //     ->where('pd_feeder_aktivitas_kuliah_mahasiswa.nama_semester', $semester_aktif[0]['nama_semester'])
        //     ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi')  || $req->has('angkatan') || $req->has('status_mahasiswa'), function($q) use($req){
        //     if ($req->keyword != '') {
        //         $q->where('pd_feeder_aktivitas_kuliah_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
        //         ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
        //         ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
        //         ;
        //     }

        //     if ($req->prodi!='') {
        //         $q->whereIn('id_prodi', $req->prodi);
        //     }

        //     if ($req->angkatan!='') {
        //         $q->whereIn('pd_feeder_aktivitas_kuliah_mahasiswa.angkatan', $req->angkatan);
        //     }

        //     if ($req->status_mahasiswa!='') {
        //         $q->whereIn('nama_status_mahasiswa', $req->status_mahasiswa);
        //     }


        //     })
        //     ->paginate($req->p != '' ? $req->p : 20);

        // }


        return view('backend.univ.perkuliahan.cek-transkrip-mahasiswa.index', compact('data' ));
        // 'angkatan_aktif',

    }



    public function detail($id,$semester)
    {
        $this->authorize('admin-univ');

        $detail = AktivitasKuliahMahasiswa::where('id_mahasiswa',$id)->where('id_semester',$semester)->select('*')->get();
        // dd($detail);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.detail', compact('detail'));
    }

}
