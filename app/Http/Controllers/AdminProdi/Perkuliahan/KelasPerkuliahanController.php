<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use PhpMyAdmin\Setup\Index;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa;
use App\Models\PDUnsri\Feeder\Perkuliahan\DetailKelasKuliah;
use App\Models\PDUnsri\Feeder\Perkuliahan\ListNilaiPerkuliahan;
use App\Models\PDUnsri\Feeder\Dosen\DosenPengajarKelasKuliah as DPKK;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\RolesUser;
use Illuminate\Support\Facades\DB;

class KelasPerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = DetailKelasKuliah::leftJoin('pd_feeder_mata_kuliah','pd_feeder_mata_kuliah.id_matkul','pd_feeder_detail_kelas_kuliah.id_matkul')
        ->leftJoin('pd_feeder_program_studi','pd_feeder_program_studi.id_prodi','pd_feeder_detail_kelas_kuliah.id_prodi')->where('pd_feeder_detail_kelas_kuliah.id_prodi', $prodiId);

        $prodi = ProgramStudi::select('id_prodi','nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi', $prodiId)->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');
        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $val = $req;

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


        return view('backend.prodi.perkuliahan.kelas-perkuliahan.index', compact('val','prodi', 'semester'));
    }

    public function kelas_data(Request $request)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $searchValue = $request->input('search.value');

        $query = DB::table('pd_feeder_list_kelas_kuliah')->select('id_semester','nama_semester', 'id_matkul', 'kode_mata_kuliah', 'nama_mata_kuliah', 'id_kelas_kuliah', 'nama_kelas_kuliah', 'sks', 'nama_dosen')->where('id_prodi', $prodiId)
        ->addSelect(DB::raw('(SELECT COUNT(id_registrasi_mahasiswa) FROM `krs_mahasiswa` WHERE krs_mahasiswa.id_matkul=pd_feeder_list_kelas_kuliah.id_matkul AND krs_mahasiswa.id_kelas=pd_feeder_list_kelas_kuliah.id_kelas_kuliah) AS jumlah_mahasiswa'));

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('kode_mata_kuliah', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_mata_kuliah', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_dosen', 'LIKE', '%'.$searchValue.'%');
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

        foreach ($data as $row) {
            $row->nama_dosen = str_replace(',', ', ', $row->nama_dosen);
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


    public function detail($id, $kelas_kuliah, $semester)
    // public function detail($id, $semester)
    {
        $this->authorize('admin-prodi');

        $data = DetailKelasKuliah::select('*')
        // leftJoin('pd_feeder_dosen_pengajar_kelas_kuliah','pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah','pd_feeder_detail_kelas_kuliah.id_kelas_kuliah');
            ->leftJoin('pd_feeder_detail_mata_kuliah', 'pd_feeder_detail_mata_kuliah.id_matkul', 'pd_feeder_detail_kelas_kuliah.id_matkul');
            // ->leftJoin('krs_mahasiswa','krs_mahasiswa.id_kelas','pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah')
            // ->orderBy('pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah');

        $data_dosen = DetailKelasKuliah::leftJoin('pd_feeder_dosen_pengajar_kelas_kuliah','pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah','pd_feeder_detail_kelas_kuliah.id_kelas_kuliah')
            ->leftJoin('pd_feeder_detail_mata_kuliah', 'pd_feeder_detail_mata_kuliah.id_matkul', 'pd_feeder_detail_kelas_kuliah.id_matkul')
            ->leftJoin('krs_mahasiswa','krs_mahasiswa.id_kelas','pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah')
            ->orderBy('pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah');

        $data_mhs = KrsMahasiswa::leftJoin('pd_feeder_dosen_pengajar_kelas_kuliah','pd_feeder_dosen_pengajar_kelas_kuliah.id_kelas_kuliah','krs_mahasiswa.id_kelas')
                ->leftJoin('pd_feeder_list_mahasiswa','pd_feeder_list_mahasiswa.id_registrasi_mahasiswa','krs_mahasiswa.id_registrasi_mahasiswa');

        $detail = $data->where('pd_feeder_detail_kelas_kuliah.id_matkul',$id)->where('pd_feeder_detail_kelas_kuliah.id_kelas_kuliah',$kelas_kuliah)->where('pd_feeder_detail_kelas_kuliah.id_semester',$semester)->select('pd_feeder_detail_kelas_kuliah.nama_program_studi', 'nama_semester', 'pd_feeder_detail_kelas_kuliah.nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah', 'sks_tatap_muka', 'sks_praktek', 'sks_praktek_lapangan', 'bahasan', 'sks_simulasi', 'metode_kuliah', 'pd_feeder_detail_kelas_kuliah.tanggal_mulai_efektif', 'pd_feeder_detail_kelas_kuliah.tanggal_akhir_efektif')->get();

        $dosen = DPKK::where('id_kelas_kuliah', $kelas_kuliah)->where('id_semester', $semester)->select('nidn', 'nama_dosen', 'sks_substansi_total', 'rencana_minggu_pertemuan', 'realisasi_minggu_pertemuan', 'nama_jenis_evaluasi')->get();
        // $data_dosen->where('pd_feeder_detail_kelas_kuliah.id_matkul',$id)->where('pd_feeder_detail_kelas_kuliah.id_semester',$semester)->distinct()->select('nidn','nama_dosen','sks_substansi_total','rencana_minggu_pertemuan', 'realisasi_minggu_pertemuan', 'nama_jenis_evaluasi')->orderBy('nama_dosen')->get();

        $mahasiswa = $data_mhs->where('krs_mahasiswa.id_matkul',$id)->where('krs_mahasiswa.id_kelas',$kelas_kuliah)->where('krs_mahasiswa.id_periode',$semester)->distinct()->select('krs_mahasiswa.nim','krs_mahasiswa.nama_mahasiswa', 'jenis_kelamin', 'pd_feeder_list_mahasiswa.nama_program_studi', 'angkatan')->get();

        return view('backend.prodi.perkuliahan.kelas-perkuliahan.detail', compact('detail', 'dosen', 'mahasiswa'));
    }
}
