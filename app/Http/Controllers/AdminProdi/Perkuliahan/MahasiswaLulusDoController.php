<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\JenisKeluar;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListMahasiswaLulusDo;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaLulusDoController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();
        $jenis_keluar = JenisKeluar::select('jenis_keluar as nama_jenis_keluar')->where('apa_mahasiswa', 1)->get();
        $angkatan = ListMahasiswaLulusDo::select('angkatan')->distinct()->orderBy('angkatan','DESC')->get();
        $tahun_keluar = ListMahasiswaLulusDo::select(DB::raw('RIGHT(tanggal_keluar, 4) as tahun_keluar'))->distinct()->get();
        //SORTING TAHUN KELUAR
        $tahun_keluar = $tahun_keluar->sortByDesc('tahun_keluar');

        $val = $req;

        return view('backend.prodi.perkuliahan.mahasiswa-lulus-do.index', compact('prodi','angkatan','jenis_keluar','tahun_keluar','angkatan','val'));
    }

    public function detail($id,$tahun)
    {
        $this->authorize('admin-prodi');

        $data = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester as semester','id_semester','id_periode_keluar');

        $detail_mahasiswa_lulus_do = $data->where('id_mahasiswa',$id)->where('angkatan',$tahun)
                ->select('nim', 'nama_mahasiswa', 'nama_program_studi', 'nama_jenis_keluar', 'tanggal_keluar', 'semester.nama_semester', 'tgl_sk_yudisium', 'sk_yudisium', 'ipk', 'keterangan', 'no_seri_ijazah')->get();

        return view('backend.prodi.perkuliahan.mahasiswa-lulus-do.detail', compact('detail_mahasiswa_lulus_do'));
    }

    public function lulusDoData(Request $request)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $searchValue = $request->input('search.value');

        $query = ListMahasiswaLulusDo::leftJoin('pd_feeder_semester','pd_feeder_semester.id_semester','pd_feeder_list_mahasiswa_lulus_do.id_periode_keluar')
            ->where('pd_feeder_list_mahasiswa_lulus_do.id_prodi',$prodiId)
            ->select('id_mahasiswa','id_prodi','pd_feeder_semester.id_tahun_ajaran as tahun_ajaran','nim', 'nama_mahasiswa', 'angkatan', 'nama_jenis_keluar','tanggal_keluar', 'pd_feeder_semester.nama_semester','keterangan')
            ->addSelect(DB::raw('(SELECT CONCAT(nama_jenjang_pendidikan," ",nama_program_studi) FROM pd_feeder_program_studi WHERE pd_feeder_program_studi.id_prodi = pd_feeder_list_mahasiswa_lulus_do.id_prodi) as nama_program_studi'));

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('nim', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_mahasiswa', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_program_studi', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('angkatan', 'LIKE', '%'.$searchValue.'%');
            });
        }

        if ($request->has('prodi') && !empty($request->input('prodi'))) {
            $prodi = $request->input('prodi');
            $query->whereIn('id_prodi', $prodi);
        }

        if ($request->has('angkatan') && !empty($request->input('angkatan'))) {
            $angkatan = $request->input('angkatan');
            $query->whereIn('angkatan', $angkatan);
        }

        if ($request->has('jenis_keluar') && !empty($request->input('jenis_keluar'))) {
            $jenis = $request->input('jenis_keluar');
            $query->whereIn('nama_jenis_keluar', $jenis);
        }

        if ($request->has('tahun_keluar') && !empty($request->input('tahun_keluar'))) {
            $jenis = $request->input('tahun_keluar');
            $query->whereIn(DB::raw('RIGHT(tanggal_keluar, 4)'), $jenis);
        }


        $recordsFiltered = $query->count();

        // limit and offset
        $limit = $request->input('length');
        $offset = $request->input('start');
        $query->skip($offset)->take($limit);

        // get data
        $data = $query->get();

        $recordsTotal = $query->count();

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
}
