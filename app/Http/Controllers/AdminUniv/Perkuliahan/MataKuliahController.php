<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\JenisMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\RencanaEvaluasi;
use App\Models\PDUnsri\Feeder\Perkuliahan\RencanaPembelajaran;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpMyAdmin\SqlParser\Components\Limit;
use Yajra\DataTables\Services\DataTable;

class MataKuliahController extends Controller
{

    public function index(Request $req)
    {
        $this->authorize('admin-univ');


        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $jenis_matkul = JenisMataKuliah::select('id_jenis_mata_kuliah', 'nama_jenis_mata_kuliah')->orderBy('id_jenis_mata_kuliah')->get();
        $val = $req;

        return view('backend.univ.perkuliahan.mata-kuliah.index', compact('prodi', 'jenis_matkul','val'));
    }

    public function mk_data(Request $request)
    {
        $searchValue = $request->input('search.value');

        $query = DB::table('pd_feeder_mata_kuliah')->leftJoin('pd_feeder_jenis_mata_kuliah','pd_feeder_jenis_mata_kuliah.id_jenis_mata_kuliah','pd_feeder_mata_kuliah.id_jenis_mata_kuliah')
                    ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', 'pd_feeder_mata_kuliah.id_jenis_mata_kuliah as id_jm', 'id_prodi', 'sks_mata_kuliah', 'pd_feeder_jenis_mata_kuliah.nama_jenis_mata_kuliah as nama_jm');

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('kode_mata_kuliah', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_mata_kuliah', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_program_studi', 'LIKE', '%'.$searchValue.'%');
            });
        }

        if ($request->has('prodi') && !empty($request->input('prodi'))) {
            $kota = $request->input('prodi');
            $query->whereIn('id_prodi', $kota);
        }

        if ($request->has('jenis_matkul') && !empty($request->input('jenis_matkul'))) {
            $matkul = $request->input('jenis_matkul');
            $query->whereIn('id_jenis_mata_kuliah', $matkul);
        }

        $recordsFiltered = $query->count();

        // limit and offset
        $limit = $request->input('length');
        $offset = $request->input('start');
        $query->skip($offset)->take($limit);

         // get data
        $data = $query->get();

        $recordsTotal = DB::table('pd_feeder_mata_kuliah')->count();

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

    public function detail_matkul($id)
    {
        $this->authorize('admin-univ');

        $rencana = RencanaPembelajaran::leftJoin('pd_feeder_aktivitas_mengajar_dosen', 'pd_feeder_aktivitas_mengajar_dosen.id_matkul', 'pd_feeder_rencana_pembelajaran.id_matkul');

        $detail_matkul = DetailMataKuliah::where('id_matkul',$id)
                ->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'nama_program_studi', 'id_jenis_mata_kuliah', 'sks_mata_kuliah', 'sks_tatap_muka', 'sks_praktek', 'sks_praktek_lapangan', 'sks_simulasi', 'metode_kuliah', 'tanggal_mulai_efektif', 'tanggal_selesai_efektif' )
                ->addSelect(DB::raw('(SELECT nama_jenis_mata_kuliah FROM pd_feeder_jenis_mata_kuliah as jenis_mk WHERE jenis_mk.id_jenis_mata_kuliah = pd_feeder_detail_mata_kuliah.id_jenis_mata_kuliah) as nama_jenis_mk'))
                ->get();
                // dd($detail_matkul);

        $pembelajaran = RencanaPembelajaran::select('id_rencana_ajar','id_matkul', 'pertemuan', 'materi_indonesia', 'materi_inggris')
                ->where('id_matkul',$id)
                ->orderBy('pertemuan', 'ASC')
                ->get();

        $evaluasi = RencanaEvaluasi::select('id_rencana_evaluasi','id_matkul', 'jenis_evaluasi', 'nama_evaluasi', 'deskripsi_indonesia', 'bobot_evaluasi')
        ->where('id_matkul',$id)
        // ->orderBy('pertemuan', 'ASC')
        ->get();


        // dd($pembelajaran);
        return view('backend.univ.perkuliahan.mata-kuliah.detail', compact('detail_matkul','pembelajaran', 'evaluasi'));
    }

    public function mk_dev(Request $req)
    {
        $this->authorize('admin-univ');

        $data = MataKuliah::leftJoin('pd_feeder_jenis_mata_kuliah','pd_feeder_jenis_mata_kuliah.id_jenis_mata_kuliah','pd_feeder_mata_kuliah.id_jenis_mata_kuliah');


        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $jenis_matkul = JenisMataKuliah::select('id_jenis_mata_kuliah', 'nama_jenis_mata_kuliah')->orderBy('id_jenis_mata_kuliah')->get();
        $val = $req;
        // dd($jenis_matkul);

        $mata_kuliah = $data->select('id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah','nama_program_studi', 'pd_feeder_mata_kuliah.id_jenis_mata_kuliah', 'nama_jenis_mata_kuliah')
        ->when($req->has('p') || $req->has('keyword') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_mata_kuliah.kode_mata_kuliah', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_mata_kuliah.nama_mata_kuliah', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
            if ($req->jenis_matkul !='') {
                $q->whereIn('pd_feeder_mata_kuliah.id_jenis_mata_kuliah', $req->jenis_matkul);
            }
        })->get();
        // dd($mata_kuliah);

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.univ.perkuliahan.mata-kuliah.mk-dev', compact('mata_kuliah','prodi', 'jenis_matkul','paginate', 'valPaginate', 'val'));
    }

}
