<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimakController extends Controller
{
    public function index()
    {
        return view('backend.univ.check-simak.index');
    }

    public function data(Request $req)
    {
        $nim = $req->nim;
        $db = DB::connection('pd_con');

        $data = $db->table('simak_transkrips')
                    ->join('simak_kelas', function($join){
                        $join->on('simak_transkrips.FKLS', '=', 'simak_kelas.KLS_KODE')
                            ->on('simak_transkrips.nm_prodi_simak', '=', 'simak_kelas.nm_prodi_simak');
                    })
                    ->join('simak_matakuliahs as m', function($j){
                        $j->on('simak_transkrips.FCOD', 'm.FCOD')
                        ->on('simak_transkrips.nm_prodi_simak', 'm.nm_prodi_simak');
                    })
                    ->where('FNIM', $nim)
                    ->select('simak_transkrips.FTAK as FTAK', 'simak_transkrips.FCOD as FCOD', 'simak_transkrips.FNIL as FNIL', 'simak_transkrips.FNIL_AKHIR as FNIL_AKHIR', 'simak_kelas.KLS_NAMA', 'm.FMAT', 'm.FSKS')
                    ->orderBy('FTAK', 'asc')
                    ->get();

        // dd($data);

        return response()->json(['data'=>$data]);
    }

    public function nilai()
    {
        $db = DB::connection('pd_con');
        $prodi = $db->table('program_studi')
                    ->select('id_prodi', 'nama_program_studi', 'kode_program_studi', 'nama_jenjang_pendidikan')->orderBy('kode_program_studi')->get();
        $ta = $db->table('simak_transkrips')->select('FTAK')->distinct()->orderBy('FTAK', 'desc')->get();

        return view('backend.univ.check-simak.nilai', compact('prodi', 'ta'));
    }

    public function nilai_data(Request $req)
    {
        $ta = $req->ta;
        $prodi = $req->prodi;
        $mk = $req->mk;
        $db = DB::connection('pd_con');

        $data = $db->table('simak_transkrips')
                    ->join('simak_mahasiswas as ma', 'ma.FMNIM', '=', 'simak_transkrips.FNIM')
                    ->join('simak_kelas', function($join){
                        $join->on('simak_transkrips.FKLS', '=', 'simak_kelas.KLS_KODE')
                            ->on('simak_transkrips.nm_prodi_simak', '=', 'simak_kelas.nm_prodi_simak');
                    })
                    ->join('simak_matakuliahs as m', function($j){
                        $j->on('simak_transkrips.FCOD', 'm.FCOD')
                        ->on('simak_transkrips.nm_prodi_simak', 'm.nm_prodi_simak');
                    })
                    ->where('simak_transkrips.id_prodi', $prodi)
                    ->where('simak_transkrips.FCOD', $mk)
                    ->where('simak_transkrips.FTAK', $ta)
                    ->select('simak_transkrips.*', 'ma.FMNAM as FMNAM', 'm.FSKS', 'simak_kelas.KLS_NAMA')
                    ->orderBy('FNIM', 'asc')
                    ->get();

        return response()->json(['data'=>$data]);
    }
}
