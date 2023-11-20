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
                    ->leftJoin('simak_kelas', function($join){
                        $join->on('simak_transkrips.FKLS', '=', 'simak_kelas.KLS_KODE')
                            ->on('simak_transkrips.nm_prodi_simak', '=', 'simak_kelas.nm_prodi_simak');
                    })
                    ->leftJoin('simak_matakuliahs as m', function($j){
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
        // $mk = $req->mk;
        $db = DB::connection('pd_con');

        $data = $db->table('simak_transkrips')
                    ->leftJoin('simak_mahasiswas as ma', 'ma.FMNIM', '=', 'simak_transkrips.FNIM')
                    ->leftJoin('simak_kelas', function($join){
                        $join->on('simak_transkrips.FKLS', '=', 'simak_kelas.KLS_KODE')
                            ->on('simak_transkrips.nm_prodi_simak', '=', 'simak_kelas.nm_prodi_simak');
                    })
                    ->leftJoin('simak_matakuliahs as m', function($j){
                        $j->on('simak_transkrips.FCOD', 'm.FCOD')
                        ->on('simak_transkrips.nm_prodi_simak', 'm.nm_prodi_simak');
                    })
                    ->leftJoin('program_studi as ps', 'ps.id_prodi', '=', 'simak_transkrips.id_prodi')
                    ->where('simak_transkrips.id_prodi', $prodi)
                    // ->where('simak_transkrips.FCOD', $mk)
                    ->where('simak_transkrips.FTAK', $ta)
                    ->select('simak_transkrips.*', 'ma.FMNAM as FMNAM', 'm.FSKS', 'simak_kelas.KLS_NAMA', 'm.FMAT as nm_mata_kuliah', 'ps.kode_program_studi as kode_prodi')
                    ->orderBy('FNIM', 'asc')
                    ->get();

        return response()->json(['data'=>$data]);
    }

    public function krs()
    {
        $db = DB::connection('pd_con');
        $prodi = $db->table('program_studi')
                    ->select('id_prodi', 'nama_program_studi', 'kode_program_studi', 'nama_jenjang_pendidikan')->orderBy('kode_program_studi')->get();
        $ta = $db->table('simak_transkrips')->select('FTAK')->distinct()->orderBy('FTAK', 'desc')->get();

        return view('backend.univ.check-simak.krs', compact('prodi', 'ta'));
    }

    public function krs_data(Request $req)
    {
        $ta = $req->ta;
        $prodi = $req->prodi;
        // $mk = $req->mk;
        $db = DB::connection('pd_con');

        $data = $db->table('simak_transkrips')
                    ->leftJoin('simak_mahasiswas as ma', 'ma.FMNIM', '=', 'simak_transkrips.FNIM')
                    ->leftJoin('simak_kelas', function($join){
                        $join->on('simak_transkrips.FKLS', '=', 'simak_kelas.KLS_KODE')
                            ->on('simak_transkrips.nm_prodi_simak', '=', 'simak_kelas.nm_prodi_simak');
                    })
                    ->leftJoin('simak_matakuliahs as m', function($j){
                        $j->on('simak_transkrips.FCOD', 'm.FCOD')
                        ->on('simak_transkrips.nm_prodi_simak', 'm.nm_prodi_simak');
                    })
                    ->leftJoin('program_studi as ps', 'ps.id_prodi', '=', 'simak_transkrips.id_prodi')
                    ->where('simak_transkrips.id_prodi', $prodi)
                    // ->where('simak_transkrips.FCOD', $mk)
                    ->where('simak_transkrips.FTAK', $ta)
                    ->select('simak_transkrips.FNIM as FNIM', 'simak_transkrips.FTAK as FTAK', 'simak_transkrips.FCOD as FCOD',
                            'ma.FMNAM as FMNAM', 'm.FSKS', 'simak_kelas.KLS_NAMA as KLS_NAMA', 'm.FMAT as nm_mata_kuliah', 'ps.kode_program_studi as kode_prodi')
                    ->orderBy('FNIM', 'asc')
                    ->get();

        return response()->json(['data'=>$data]);
    }

    public function kelas()
    {
        $db = DB::connection('pd_con');
        $prodi = $db->table('program_studi')
                    ->select('id_prodi', 'nama_program_studi', 'kode_program_studi', 'nama_jenjang_pendidikan')->orderBy('kode_program_studi')->get();
        $ta = $db->table('simak_kelas')->select('KLS_TAK')->distinct()->orderBy('KLS_TAK', 'desc')->get();

        return view('backend.univ.check-simak.kelas', compact('prodi', 'ta'));
    }

    public function kelas_data(Request $req)
    {
        $ta = $req->ta;
        $prodi = $req->prodi;
        // $mk = $req->mk;
        $db = DB::connection('pd_con');

        $data = $db->table('simak_kelas')
                    ->leftJoin('program_studi as ps', 'ps.id_prodi', '=', 'simak_kelas.id_prodi')
                    ->leftJoin('simak_matakuliahs as m', function($j){
                        $j->on('simak_kelas.KLS_KODEMK', 'm.FCOD')
                        ->on('simak_kelas.nm_prodi_simak', 'm.nm_prodi_simak');
                    })
                    ->where('simak_kelas.id_prodi', $prodi)
                    // ->where('simak_transkrips.FCOD', $mk)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->select('simak_kelas.KLS_TAK as KLS_TAK', 'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'm.FMAT as FMAT', 'simak_kelas.KLS_NAMA as KLS_NAMA',
                                'ps.kode_program_studi as kode_prodi')
                    ->orderBy('KLS_KODEMK', 'asc')
                    ->get();

        return response()->json(['data'=>$data]);
    }

    public function dosen_ajar()
    {
        $db = DB::connection('pd_con');

        $prodi = $db->table('program_studi')
                    ->select('id_prodi', 'nama_program_studi', 'kode_program_studi', 'nama_jenjang_pendidikan')->orderBy('kode_program_studi')->get();
        $ta = $db->table('simak_transkrips')->select('FTAK')->distinct()->orderBy('FTAK', 'desc')->get();

        return view('backend.univ.check-simak.dosen-ajar', compact('prodi', 'ta'));
    }

    public function dosen_ajar_data(Request $req)
    {

        $ta = $req->ta;
        $prodi = $req->prodi;
        // $mk = $req->mk;
        $db = DB::connection('pd_con');

        $dsn2 = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN2', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN2 <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN2 = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN2 = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                CASE
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN (16/6)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 3
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN (16/4)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 5
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN (16/2)
                                    ELSE 16
                                END AS tatap_muka
                            '));

        $dsn3 = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN3', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN3 <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN3 = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN3 = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                CASE
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN (16/6)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 3
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN (16/4)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 5
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN (16/2)
                                    ELSE 16
                                END AS tatap_muka
                            '));
        $dsn4 = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN4', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN4 <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN4 = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN4 = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                CASE
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN (16/6)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 3
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN (16/4)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 5
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN (16/2)
                                    ELSE 16
                                END AS tatap_muka
                            '));

        $dsn5 = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN5', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN4 <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN5 = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN5 = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                CASE
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN (16/6)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 3
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN (16/4)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 5
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN (16/2)
                                    ELSE 16
                                END AS tatap_muka
                            '));

        $dsn6 = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN6', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN6 <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN6 = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN6 = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                CASE
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN (16/6)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 3
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN (16/4)
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 5
                                    WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN (16/2)
                                    ELSE 16
                                END AS tatap_muka
                            '));

        $data = $db->table('simak_kelas')
                    ->where('simak_kelas.id_prodi', $prodi)
                    ->where('simak_kelas.KLS_TAK', $ta)
                    ->where('simak_kelas.KLS_DSN', '!=', '')
                    ->whereRaw('simak_kelas.KLS_DSN <> 1')
                    ->select('simak_kelas.KLS_TAK as KLS_TAK',
                                DB::raw('(SELECT FNIP FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN = simak_dosens.FCOD) as nip'),
                                DB::raw('(SELECT FNAM FROM simak_dosens WHERE simak_kelas.nm_fakultas = simak_dosens.nm_fakultas AND simak_kelas.KLS_DSN = simak_dosens.FCOD) as nama_dosen'),
                                DB::raw('(SELECT kode_program_studi FROM program_studi WHERE simak_kelas.id_prodi = program_studi.id_prodi) as kode_prodi'),
                                'simak_kelas.KLS_KODEMK as KLS_KODEMK', 'simak_kelas.KLS_NAMA as KLS_NAMA')
                    ->addSelect(DB::raw('
                                            CASE
                                                WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) AND (KLS_DSN6 IS NOT NULL AND KLS_DSN6 <> 1) THEN CAST((16/6) AS SIGNED)
                                                WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) AND (KLS_DSN5 IS NOT NULL AND KLS_DSN5 <> 1) THEN 4
                                                WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) AND (KLS_DSN4 IS NOT NULL AND KLS_DSN4 <> 1) THEN CAST((16/4) AS SIGNED)
                                                WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) AND (KLS_DSN3 IS NOT NULL AND KLS_DSN3 <> 1) THEN 6
                                                WHEN (KLS_DSN IS NOT NULL AND KLS_DSN <> 1) AND (KLS_DSN2 IS NOT NULL AND KLS_DSN2 <> 1) THEN CAST((16/2) AS SIGNED)
                                                ELSE 16
                                            END AS tatap_muka
                                        '))
                    ->union($dsn2)
                    ->union($dsn3)
                    ->union($dsn4)
                    ->union($dsn5)
                    ->union($dsn6)
                    ->orderBy('KLS_KODEMK', 'asc')
                    ->orderBy('KLS_NAMA')
                    ->get();

        return response()->json(['data'=>$data]);
    }
}
