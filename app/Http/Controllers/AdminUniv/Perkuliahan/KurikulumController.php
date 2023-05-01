<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKurikulum;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailMataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListKurikulum;
use App\Models\PDUnsri\Feeder\Perkuliahan\MataKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\MatkulKurikulum;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurikulumController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');


        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $val = $req;

        return view('backend.univ.perkuliahan.kurikulum.index', compact('prodi','val'));
    }

    public function getData(Request $request)
    {
        $this->authorize('admin-univ');

        $searchValue = $request->input('search.value');

        $query = ListKurikulum::select('id_kurikulum', 'id_prodi', 'nama_kurikulum', 'nama_program_studi', 'semester_mulai_berlaku', 'jumlah_sks_lulus','jumlah_sks_wajib', 'jumlah_sks_pilihan','jumlah_sks_mata_kuliah_wajib','jumlah_sks_mata_kuliah_pilihan');

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pd_feeder_list_kurikulum.nama_kurikulum', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('pd_feeder_list_kurikulum.nama_program_studi', 'LIKE', '%'.$searchValue.'%');
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

         // get data
        $data = $query->get();

        $recordsTotal = ListKurikulum::count();

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
        $this->authorize('admin-univ');

        $data = new(DetailKurikulum::class);

        $data1 = new(MatkulKurikulum::class);

        $detail_kurikulum = $data->where('id_kurikulum',$id)
                ->select('nama_kurikulum', 'nama_program_studi', 'semester_mulai_berlaku', 'jumlah_sks_lulus', 'jumlah_sks_wajib', 'jumlah_sks_pilihan')->get();

        $mata_kuliah_kurikulum = $data1->where('id_kurikulum',$id)
                ->select('kode_mata_kuliah','nama_mata_kuliah','sks_mata_kuliah','sks_tatap_muka','sks_praktek','sks_praktek_lapangan','sks_simulasi','semester','apakah_wajib')->orderBy('semester','ASC')->get();

        $sum_sks_mata_kuliah = $mata_kuliah_kurikulum->sum('sks_mata_kuliah');
        $sum_sks_tatap_muka = $mata_kuliah_kurikulum->sum('sks_tatap_muka');
        $sum_sks_praktek = $mata_kuliah_kurikulum->sum('sks_praktek');
        $sum_sks_praktek_lapangan = $mata_kuliah_kurikulum->sum('sks_praktek_lapangan');
        $sum_sks_simulasi = $mata_kuliah_kurikulum->sum('sks_simulasi');


        return view('backend.univ.perkuliahan.kurikulum.detail', compact('detail_kurikulum','mata_kuliah_kurikulum','sum_sks_mata_kuliah','sum_sks_tatap_muka','sum_sks_praktek','sum_sks_praktek_lapangan','sum_sks_simulasi'));
    }
}
