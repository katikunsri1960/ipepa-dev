<?php

namespace App\Http\Controllers\AdminUniv\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use App\Models\PDUnsri\Feeder\BiodataMahasiswa;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa as AKM;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListRiwayatPendidikanMahasiswa as ListRPM;
use App\Models\PDUnsri\Feeder\Mahasiswa\TranskripMahasiswa as TM;
use App\Models\PDUnsri\Feeder\Mahasiswa\KrsMahasiswa as KM;
use App\Models\PDUnsri\Feeder\Mahasiswa\RiwayatNilaiMahasiswa as RNM;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListPrestasiMahasiswa as LPM;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\PDUnsri\Feeder\StatusMahasiswa;
use App\Models\PDUnsri\Feeder\Agama;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\TahunAjaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        // $data= ListMahasiswa::leftJoin('pd_feeder_semester as semester','id_semester','id_periode');
        $data = new ListMahasiswa;

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->orderBy('nama_jenjang_pendidikan','ASC')->get();
        $status = $data->select('nama_status_mahasiswa')->distinct()->get();
        $agama = Agama::select('id_agama','nama_agama')->get();
        $angkatan = Semester::select('id_tahun_ajaran as angkatan')->distinct()->orderBy('id_tahun_ajaran', 'desc')->get();
        // dd($angkatan);
        $jk = $data->select('jenis_kelamin')->distinct()->get();

        $val = $req;

        return view('backend.univ.mahasiswa.index', compact('status', 'agama', 'angkatan', 'jk', 'val', 'prodi'));
    }

    public function getData(Request $request)
    {
        $searchValue = $request->input('search.value');
        $query = ListMahasiswa::leftJoin('pd_feeder_semester as semester','id_semester','id_periode')->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_mahasiswa as id_mahasiswa',
             'pd_feeder_list_mahasiswa.nama_mahasiswa as nama_mahasiswa', 'pd_feeder_list_mahasiswa.nim as nim', 'pd_feeder_list_mahasiswa.jenis_kelamin as jenis_kelamin',
                'pd_feeder_list_mahasiswa.nama_agama as nama_agama', 'pd_feeder_list_mahasiswa.total_sks as total_sks', 'pd_feeder_list_mahasiswa.tanggal_lahir as tanggal_lahir',
                'pd_feeder_list_mahasiswa.nama_program_studi as nama_program_studi',
                'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status_mahasiswa', 'semester.id_tahun_ajaran as angkatan')
            // ->addSelect(DB::raw('(SELECT id_tahun_ajaran from pd_feeder_semester as semester where semester.id_semester = pd_feeder_list_mahasiswa.id_periode) as angkatan'))
            ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) from pd_feeder_transkrip_mahasiswa where id_registrasi_mahasiswa = pd_feeder_list_mahasiswa.id_registrasi_mahasiswa) as total'))
            ->orderBy('pd_feeder_list_mahasiswa.id_prodi', 'asc')
            ->orderBy('pd_feeder_list_mahasiswa.nim', 'asc');

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pd_feeder_list_mahasiswa.nama_mahasiswa', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('pd_feeder_list_mahasiswa.nim', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('pd_feeder_list_mahasiswa.nama_program_studi', 'LIKE', '%'.$searchValue.'%');
            });
        }

        if ($request->has('prodi') && !empty($request->input('prodi'))) {
            $f = $request->input('prodi');
            $query->whereIn('id_prodi', $f);
        }

        if ($request->has('angkatan') && !empty($request->input('angkatan'))) {
            $f = $request->input('angkatan');
            $query->whereIn('semester.id_tahun_ajaran', $f);
        }

        if ($request->has('status') && !empty($request->input('status'))) {
            $f = $request->input('status');
            $query->whereIn('nama_status_mahasiswa', $f);
        }

        if ($request->has('jk') && !empty($request->input('jk'))) {
            $f = $request->input('jk');
            $query->whereIn('jenis_kelamin', $f);
        }
        if ($request->has('agama') && !empty($request->input('agama'))) {
            $f = $request->input('agama');
            $query->whereIn('id_agama', $f);
        }

        $recordsFiltered = $query->count();

         // limit and offset
         $limit = $request->input('length');
        $offset = $request->input('start');
        $query->skip($offset)->take($limit);

        $data = $query->get();

        $recordsTotal = ListMahasiswa::count();

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
        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa',$id)->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'nama_ibu_kandung', 'nik', 'jenis_kelamin',
                        'tanggal_lahir', 'nama_agama', 'kewarganegaraan', 'nisn', 'npwp', 'jalan', 'handphone', 'telepon',
                        'dusun', 'rt','rw', 'kelurahan', 'kode_pos', 'email','nama_wilayah', 'nama_alat_transportasi', 'penerima_kps', 'nomor_kps', 'nama_jenis_tinggal',
                        'nama_ayah', 'nik_ayah', 'nik_ibu', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'nama_pendidikan_ayah', 'nama_pendidikan_ibu',
                        'nama_penghasilan_ayah', 'nama_penghasilan_ibu', 'nama_wali', 'nama_pekerjaan_wali', 'tanggal_lahir_wali', 'nama_penghasilan_wali', 'nama_pendidikan_wali',
                        'nama_kebutuhan_khusus_mahasiswa')->first();

        // $aktivitas = AktivitasKuliahMahasiswa::where('id_mahasiswa', $id)->get();
        return view('backend.univ.mahasiswa.detail-mahasiswa', compact('mahasiswa'));
    }

    public function histori($id)
    {
        $this->authorize('admin-univ');

        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa', $id)
                    ->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'jenis_kelamin', 'tanggal_lahir', 'nama_agama')->first();

        $riwayat = ListRPM::where('id_mahasiswa', $id)
                    ->select('nim', 'nama_jenis_daftar', 'nama_periode_masuk', 'tanggal_daftar', 'nama_program_studi', 'nama_perguruan_tinggi', 'nama_pembiayaan_awal', 'biaya_masuk',
                            'nama_perguruan_tinggi', 'nm_bidang_minat as nama_bidang_minat')
                    ->addSelect(DB::raw('(SELECT nama_jalur_masuk from pd_feeder_jalur_masuk AS jm WHERE pd_feeder_list_riwayat_pendidikan_mahasiswa.id_jalur_daftar = id_jalur_masuk) as jalur_masuk'))
                    ->get();
        // dd($riwayat);

        return view('backend.univ.mahasiswa.histori-pendidikan', compact('mahasiswa', 'riwayat'));
    }

    public function aktivitas($id)
    {
        $this->authorize('admin-univ');
        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();
        $aktivitas = AKM::where('id_mahasiswa', $id)->select('nama_semester', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')->get();

        return view('backend.univ.mahasiswa.aktivitas-perkuliahan', compact('mahasiswa', 'aktivitas'));
    }

    public function transkrip($id)
    {
        $this->authorize('admin-univ');
        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'id_registrasi_mahasiswa','nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();
        $transkrip = TM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->get();

        return view('backend.univ.mahasiswa.transkrip-mahasiswa', compact('mahasiswa', 'transkrip'));
    }

    public function krs(Request $req, $id)
    {
        $this->authorize('admin-univ');

        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'id_registrasi_mahasiswa','nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();


        $periode = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('id_periode')->distinct()
                    ->addSelect(DB::raw('(SELECT nama_semester FROM pd_feeder_semester WHERE id_semester=pd_feeder_krs_mahasiswa.id_periode) as nama_periode'))
                    ->get();

        $periodeNow = $periode->toArray();

        $periodeAkt = NULL;

        if ($req->has('periode')) {

            $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $req->periode)
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah')
                    ->get();

            $periodeAkt = $req->periode;

        } else {

            if (empty($periodeNow)) {
                $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah')
                    ->get();
            } else {

                $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $periodeNow[0])
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah')
                    ->get();

                $periodeAkt = $periodeNow[0]['id_periode'];
            }
        }

        return view('backend.univ.mahasiswa.krs-mahasiswa', compact('mahasiswa', 'krs', 'periodeNow', 'periodeAkt'));
    }


    public function histori_nilai(Request $req, $id)
    {
        $this->authorize('admin-univ');

        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan', 'id_registrasi_mahasiswa')->first();

        $periode = RNM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('id_periode')->distinct()
                    ->addSelect(DB::raw('(SELECT nama_semester FROM pd_feeder_semester WHERE id_semester=pd_feeder_riwayat_nilai_mahasiswa.id_periode) as nama_periode'))
                    ->get();

        $periodeNow = $periode->toArray();

        $periodeAkt = NULL;

        if ($req->has('periode')) {

            $histori = RNM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $req->periode)
                    ->select('id_matkul', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->addSelect(DB::raw('(SELECT kode_mata_kuliah from pd_feeder_mata_kuliah where pd_feeder_riwayat_nilai_mahasiswa.id_matkul = id_matkul) as kode_mata_kuliah'))
                    ->get();
            $periodeAkt = $req->periode;

        } else {

            if (empty($periodeNow)) {
                $histori = RNM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('id_matkul', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->addSelect(DB::raw('(SELECT kode_mata_kuliah from pd_feeder_mata_kuliah where pd_feeder_riwayat_nilai_mahasiswa.id_matkul = id_matkul) as kode_mata_kuliah'))
                    ->get();
            } else {
                $histori = RNM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $periodeNow[0])
                    ->select('id_matkul', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->addSelect(DB::raw('(SELECT kode_mata_kuliah from pd_feeder_mata_kuliah where pd_feeder_riwayat_nilai_mahasiswa.id_matkul = id_matkul) as kode_mata_kuliah'))
                    ->get();

                $periodeAkt = $periodeNow[0]['id_periode'];
            }
        }

        // dd($histori);
        return view('backend.univ.mahasiswa.histori-nilai', compact('mahasiswa', 'periodeNow','histori', 'periodeAkt'));
    }

    public function prestasi($id)
    {
        $this->authorize('admin-univ');

        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa', $id)
                    ->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'jenis_kelamin', 'tanggal_lahir', 'nama_agama')->first();

        $prestasi = LPM::where('id_mahasiswa', $id)
                    ->select('nama_jenis_prestasi', 'nama_tingkat_prestasi', 'nama_prestasi', 'tahun_prestasi', 'penyelenggara', 'peringkat')
                    ->get();

        return view('backend.univ.mahasiswa.prestasi-mahasiswa', compact('mahasiswa', 'prestasi'));

    }

}
