<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Support\Facades\DB;
use App\Services\FeederApi;

class HitungTranskripController extends Controller
{
    public function index()
    {
        $prodi = ProgramStudi::all();
        $angkatan = DB::table('pd_feeder_semester')->select('id_tahun_ajaran')->distinct()->orderBy('id_tahun_ajaran', 'desc')->get();
        // dd($angkatan[0]->id_tahun_ajaran);
        return view('backend.admin.hitung-transkrip', [
            'prodi' => $prodi,
            'angkatan' => $angkatan
        ]);
    }

    public function hitung(Request $req)
    {
        $prodi = $req->prodi;
        $angkatan = $req->angkatan;

        $request = new FeederApi('HitungTranskripAngkatan', $angkatan, $prodi);
        $response = $request->runWS();

        return response()->json($response, 200);
    }
}
