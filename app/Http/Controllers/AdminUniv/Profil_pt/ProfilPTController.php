<?php

namespace App\Http\Controllers\AdminUniv\Profil_pt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProfilPt;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Illuminate\Support\Facades\DB;

class ProfilPTController extends Controller
{
    public function index()
    {
        $this->authorize('admin-univ');

        $profil_pt = ProfilPt::select('kode_perguruan_tinggi', 'nama_perguruan_tinggi', 'telepon',
                'faximile', 'email', 'website', 'jalan', 'dusun', 'rt_rw','kelurahan','nama_wilayah','kode_pos','lintang_bujur','bank','unit_cabang'
                ,'nomor_rekening','mbs','luas_tanah_milik','luas_tanah_bukan_milik','sk_pendirian','tanggal_sk_pendirian','nama_status_milik','status_perguruan_tinggi','sk_izin_operasional','tanggal_izin_operasional')->get();

        $data_prodi = ProgramStudi::select('*')->orderBy('kode_program_studi', 'ASC')->get();

        foreach($data_prodi as $prodi){
            $mahasiswa = ListMahasiswa::select('id_mahasiswa')->where('id_prodi',$prodi->id_prodi)->where('id_periode','20211')->get();
        }
        dd($mahasiswa);

        return view('backend.univ.profil_pt.index', compact('profil_pt','data_prodi','mahasiswa'));
    }
}
