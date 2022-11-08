<?php

namespace App\Http\Controllers\AdminProdi\Profil_pt;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\ProfilPt;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilPTController extends Controller
{
    public function index()
    {
        $this->authorize('admin-prodi');

        $profil_pt = ProfilPt::select('kode_perguruan_tinggi', 'nama_perguruan_tinggi', 'telepon',
                'faximile', 'email', 'website', 'jalan', 'dusun', 'rt_rw','kelurahan','nama_wilayah','kode_pos','lintang_bujur','bank','unit_cabang'
                ,'nomor_rekening','mbs','luas_tanah_milik','luas_tanah_bukan_milik','sk_pendirian','tanggal_sk_pendirian','nama_status_milik','status_perguruan_tinggi','sk_izin_operasional','tanggal_izin_operasional')->get();

        $data_prodi = ProgramStudi::select('*')
                    ->addSelect(DB::raw('(SELECT COUNT(id_dosen) FROM pd_feeder_detail_penugasan_dosen WHERE id_prodi = pd_feeder_program_studi.id_prodi AND id_tahun_ajaran = "2022") AS jumlah_dosen'))
                    ->addSelect(DB::raw('(SELECT COUNT(id_mahasiswa) from pd_feeder_list_mahasiswa WHERE id_prodi = pd_feeder_program_studi.id_prodi) AS jumlah_mahasiswa'))
                    ->orderBy('kode_program_studi', 'ASC')
                    ->get();
        // dd($data_prodi);

        return view('backend.prodi.profil_pt.index', compact('profil_pt','data_prodi'));
    }
}
