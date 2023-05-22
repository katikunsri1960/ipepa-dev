<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa as KM;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\StatusMahasiswa;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Illuminate\Support\Facades\DB;

class AktivitasKuliahMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan')->orderBy('nama_program_studi')->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $semester_aktif = $semester->toArray();
        $angkatan = Semester::select('pd_feeder_semester.id_tahun_ajaran')->distinct()->orderBy('pd_feeder_semester.id_tahun_ajaran','DESC')->get();
        $val = $req;
        $status_mahasiswa = StatusMahasiswa::select('id_status_mahasiswa', 'nama_status_mahasiswa')->get();

        $year = date('Y');
        $month = date('m');
        if ($month < 7) {
            $aktif = ($year-1).'2';
        } else {
            $aktif = $year.'1';
        }

        if ($req->semester == null) {
          $val->semester = [$aktif];
        }
        // dd($val->semester);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.index', compact('val','prodi',
        'semester', 'semester_aktif','angkatan' ,'status_mahasiswa'));
        // 'angkatan_aktif',

    }

    public function akm_data(Request $request)
    {
        $this->authorize('admin-univ');

        $searchValue = $request->input('search.value');

        $query = DB::table('pd_feeder_aktivitas_kuliah_mahasiswa')->select('id_mahasiswa','nim', 'nama_mahasiswa', 'nama_program_studi', 'id_prodi', 'id_semester', 'angkatan', 'nama_semester', 'nama_status_mahasiswa', 'ipk','ips','sks_semester', 'sks_total');

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

        if ($request->has('semester') && !empty($request->input('semester'))) {
            if($request->input('semester') != 'all')
            {
                $semester = $request->input('semester');
                $query->whereIn('id_semester', $semester);
            }
        }

        if ($request->has('angkatan') && !empty($request->input('angkatan'))) {
            $angkatan = $request->input('angkatan');
            $query->whereIn('angkatan', $angkatan);
        }

        if ($request->has('status_mahasiswa') && !empty($request->input('status_mahasiswa'))) {
            $semester = $request->input('status_mahasiswa');
            $query->whereIn('nama_status_mahasiswa', $semester);
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

    public function detail($id,$semester)
    {
        $this->authorize('admin-univ');

        $detail = AktivitasKuliahMahasiswa::where('id_mahasiswa',$id)->where('id_semester',$semester)->select('*')->get();
        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'id_registrasi_mahasiswa','nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();

        $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $semester)
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah', 'id_registrasi_mahasiswa')
                    ->addSelect(DB::raw('(SELECT nama_semester FROM pd_feeder_semester WHERE id_semester=pd_feeder_krs_mahasiswa.id_periode) as semester'))
                    // ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) FROM pd_feeder_krs_mahasiswa WHERE pd_feeder_krs_mahasiswa.id_periode='.$semester.') AS jumlah_sks'))
                    ->get();

        $sks = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                   ->where('id_periode', $semester)
                   ->select(DB::raw('SUM(sks_mata_kuliah) AS jumlah_sks'))->get();

        // dd($krs);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.detail', compact('detail', 'mahasiswa', 'krs','sks'));
    }
}
