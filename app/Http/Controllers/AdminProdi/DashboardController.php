<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\ProfilPt;
use App\Models\PDUnsri\Feeder\SyncTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $val = $req;

        $profil_pt = ProfilPt::select('kode_perguruan_tinggi', 'nama_perguruan_tinggi', 'telepon',
                'faximile', 'email', 'website', 'jalan', 'dusun', 'rt_rw','kelurahan','nama_wilayah','kode_pos','lintang_bujur','bank','unit_cabang'
                ,'nomor_rekening','mbs','luas_tanah_milik','luas_tanah_bukan_milik','sk_pendirian','tanggal_sk_pendirian','nama_status_milik','status_perguruan_tinggi','sk_izin_operasional','tanggal_izin_operasional')->get();

        $sync_table = SyncTable::select('*')
        ->when($req->has('p') ||$req->has('keyword'), function($q) use($req) {
            if ($req->keyword != '') {
                $q->where('sync_tables.table_name', 'like', '%'.$req->keyword.'%');
            }
        })->paginate($req->p != '' ? $req->p : 20);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        $jumlah_data_sync = SyncTable::select('*')->orderby('id','desc')->get();

        return view('backend.prodi.dashboard', compact("profil_pt", "sync_table",'val', 'paginate', 'valPaginate', 'jumlah_data_sync'));
    }
}
