<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use Illuminate\Http\Request;
use PhpMyAdmin\Setup\Index;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Illuminate\Support\Facades\DB;

class AktivitasKuliahMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $aktivitas_kuliah_mahasiswa =

        $aktivitas_kuliah_mahasiswa = AktivitasKuliahMahasiswa::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_aktivitas_kuliah_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('id_mahasiswa', 'id_semester', 'nama_semester', 'nim', 'nama_mahasiswa','angkatan', 'nama_program_studi', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')
        // ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
        ->paginate(20);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.index', compact('aktivitas_kuliah_mahasiswa'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        $detail = AktivitasKuliahMahasiswa::where('id_mahasiswa',$id)
        ->select('id_mahasiswa', 'id_semester', 'nama_semester', 'nim', 'nama_mahasiswa','angkatan', 'nama_program_studi', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')
        ->paginate(20);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.detail', compact('detail'));
    }

}
