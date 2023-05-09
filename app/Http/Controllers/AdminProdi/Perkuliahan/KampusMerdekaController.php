<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Support\Facades\DB;
use App\Models\RolesUser;

class KampusMerdekaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('id_prodi', $prodiId)->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $val = $req;


        return view('backend.prodi.perkuliahan.kampus-merdeka.index', compact('prodi', 'val'));
    }

    public function merdekaData(Request $request)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $searchValue = $request->input('search.value');

        $jenis = DB::table('pd_feeder_jenis_aktivitas_mahasiswa')->where('untuk_kampus_merdeka', 1)->pluck('id_jenis_aktivitas_mahasiswa');
        $query = DB::table('pd_feeder_list_aktivitas_mahasiswa')->whereIn('id_jenis_aktivitas', $jenis)
                    ->select('id_aktivitas', 'nama_prodi', 'nama_semester', 'nama_jenis_aktivitas', 'judul', 'nama_program_mbkm')
                    ->where('id_prodi', $prodiId);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('nama_prodi', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('judul', 'LIKE', '%'.$searchValue.'%');
            });
        }

        if ($request->has('prodi') && !empty($request->input('prodi'))) {
            $kota = $request->input('prodi');
            $query->whereIn('id_prodi', $kota);
        }

        $recordsFiltered = $query->count();

        // limit and offset
        $limit = $request->input('length');
        $offset = $request->input('start');
        $query->skip($offset)->take($limit);

        $data = $query->get();

        $recordsTotal = DB::table('pd_feeder_list_aktivitas_mahasiswa')->whereIn('id_jenis_aktivitas', $jenis)->count();

        // add numbering
        $number = $offset + 1;
        foreach ($data as $d) {
            $d->number = $number;
            $number++;
        }

        // prepare response
        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return response()->json($response);
    }

    public function detail($id)
    {
        $this->authorize('admin-prodi');

        $data = DB::table('pd_feeder_list_aktivitas_mahasiswa')->where('id_aktivitas', $id)->first();

        $anggota = DB::table('pd_feeder_list_anggota_aktivitas_mahasiswa')->where('id_aktivitas', $id)->get();

        return view('backend.prodi.perkuliahan.kampus-merdeka.detail', compact('data', 'anggota'));
    }
}
