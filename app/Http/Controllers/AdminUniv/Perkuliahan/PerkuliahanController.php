<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpMyAdmin\SqlParser\Components\Limit;

class PerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $mk =

        $mk = MataKuliah::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_mata_kuliah.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_mata_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah','nama_program_studi', 'id_jenis_mata_kuliah')
        ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
        ->paginate(20);

        return view('backend.univ.perkuliahan.daftar-mata-kuliah', compact('mk'));
    }

    public function detail_matkul($id)
    {
        $this->authorize('admin-univ');

        $detail_matkul = DetailMataKuliah::where('id_matkul',$id)
                ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', 'id_jenis_mata_kuliah', 'sks_mata_kuliah', 'sks_tatap_muka', 'sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi', 'metode_kuliah', 'tanggal_mulai_efektif', 'tanggal_selesai_efektif' )
                ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_detail_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
                // ->paginate(20)
                ->get();
                // dd($detail_matkul($id));

        return view('backend.univ.perkuliahan.detail-mata-kuliah', compact('detail_matkul'));
    }

    public function substansi_kuliah()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.substansi-kuliah');
    }

    public function kurikulum()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.kurikulum');
    }

    public function kelas_perkuliahan()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.kelas-perkuliahan');
    }

    public function nilai_perkuliahan()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.nilai-perkuliahan');
    }

    public function aktivitas_kuliah_mahasiswa()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa');
    }

    public function aktivitas_mahasiswa()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.aktivitas-mahasiswa');
    }

    public function kampus_merdeka()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.kampus-merdeka');
    }

    public function daftar_mahasiswa_lulus_do()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.mahasiswa-lulus-do');
    }

    public function transkrip_mahasiswa()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.transkrip-mahasiswa');
    }
}
