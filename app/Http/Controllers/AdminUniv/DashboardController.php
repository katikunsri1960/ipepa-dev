<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProfilPt;
use App\Models\PDUnsri\Feeder\SyncTable;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('admin-univ');

        $profil_pt = ProfilPt::select('kode_perguruan_tinggi', 'nama_perguruan_tinggi', 'telepon',
                'faximile', 'email', 'website', 'jalan', 'dusun', 'rt_rw','kelurahan','nama_wilayah','kode_pos','lintang_bujur','bank','unit_cabang'
                ,'nomor_rekening','mbs','luas_tanah_milik','luas_tanah_bukan_milik','sk_pendirian','tanggal_sk_pendirian','nama_status_milik','status_perguruan_tinggi','sk_izin_operasional','tanggal_izin_operasional')->get();

        $sync_table = SyncTable::select('*')->orderBy('id','DESC')->get();

        return view('backend.univ.dashboard', compact('profil_pt','sync_table'));
    }
}
