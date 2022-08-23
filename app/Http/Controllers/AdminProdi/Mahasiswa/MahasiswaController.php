<?php

namespace App\Http\Controllers\AdminProdi\Mahasiswa;

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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\RolesUser;

class MahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');
        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = ListMahasiswa::where('id_prodi', $prodiId);
                // ->leftJoin('pd_feeder_transkrip_mahasiswa as tm', 'pd_feeder_list_mahasiswa.id_registrasi_mahasiswa', 'tm.id_registrasi_mahasiswa');


        $mahasiswa = $data
            ->when($req->has('keyword'), function($q) use($req, $prodiId) {
                if ($req->keyword != '') {
                    $q->where('pd_feeder_list_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')->where('id_prodi', $prodiId)
                    ->orWhere('pd_feeder_list_mahasiswa.nim', 'like', '%'.$req->keyword.'%')->where('id_prodi', $prodiId)
                    ->orWhere('pd_feeder_list_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')->where('id_prodi', $prodiId);
                }
            })
            ->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_mahasiswa as id_mahasiswa',
             'pd_feeder_list_mahasiswa.nama_mahasiswa as nama_mahasiswa', 'pd_feeder_list_mahasiswa.nim as nim', 'pd_feeder_list_mahasiswa.jenis_kelamin as jenis_kelamin',
                'pd_feeder_list_mahasiswa.nama_agama as nama_agama', 'pd_feeder_list_mahasiswa.total_sks as total_sks', 'pd_feeder_list_mahasiswa.tanggal_lahir as tanggal_lahir',
                'pd_feeder_list_mahasiswa.nama_program_studi as nama_program_studi',
                'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status_mahasiswa', 'pd_feeder_list_mahasiswa.id_periode as id_periode')
            ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) from pd_feeder_transkrip_mahasiswa where id_registrasi_mahasiswa = pd_feeder_list_mahasiswa.id_registrasi_mahasiswa) as total'))
            ->paginate(20);

        // dd($mahasiswa);

        return view('backend.prodi.mahasiswa.index', compact('mahasiswa'));
    }

    public function detail($id)
    {
        $this->authorize('admin-prodi');
        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa',$id)->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'nama_ibu_kandung', 'nik', 'jenis_kelamin',
                        'tanggal_lahir', 'nama_agama', 'kewarganegaraan', 'nisn', 'npwp', 'jalan', 'handphone', 'telepon',
                        'dusun', 'rt','rw', 'kelurahan', 'kode_pos', 'email','nama_wilayah', 'nama_alat_transportasi', 'penerima_kps', 'nomor_kps', 'nama_jenis_tinggal',
                        'nama_ayah', 'nik_ayah', 'nik_ibu', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'nama_pendidikan_ayah', 'nama_pendidikan_ibu',
                        'nama_penghasilan_ayah', 'nama_penghasilan_ibu', 'nama_wali', 'nama_pekerjaan_wali', 'tanggal_lahir_wali', 'nama_penghasilan_wali', 'nama_pendidikan_wali',
                        'nama_kebutuhan_khusus_mahasiswa')->first();

        // $aktivitas = AktivitasKuliahMahasiswa::where('id_mahasiswa', $id)->get();
        return view('backend.prodi.mahasiswa.detail-mahasiswa', compact('mahasiswa'));
    }

    public function histori($id)
    {
        $this->authorize('admin-prodi');

        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa', $id)
                    ->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'jenis_kelamin', 'tanggal_lahir', 'nama_agama')->first();

        $riwayat = ListRPM::where('id_mahasiswa', $id)
                ->select('nim', 'nama_jenis_daftar', 'nama_periode_masuk', 'tanggal_daftar', 'nama_program_studi', 'nama_perguruan_tinggi', 'nama_pembiayaan_awal', 'biaya_masuk',
                        'nama_perguruan_tinggi', 'nm_bidang_minat as nama_bidang_minat')
                ->addSelect(DB::raw('(SELECT nama_jalur_masuk from pd_feeder_jalur_masuk AS jm WHERE pd_feeder_list_riwayat_pendidikan_mahasiswa.id_jalur_daftar = id_jalur_masuk) as jalur_masuk'))
                ->get();
        // dd($riwayat);

        return view('backend.prodi.mahasiswa.histori-pendidikan', compact('mahasiswa', 'riwayat'));
    }

    public function aktivitas($id)
    {
        $this->authorize('admin-prodi');
        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();
        $aktivitas = AKM::where('id_mahasiswa', $id)->select('nama_semester', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')->get();

        return view('backend.prodi.mahasiswa.aktivitas-perkuliahan', compact('mahasiswa', 'aktivitas'));
    }

    public function transkrip($id)
    {
        $this->authorize('admin-prodi');
        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'id_registrasi_mahasiswa','nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();
        $transkrip = TM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->get();

        return view('backend.prodi.mahasiswa.transkrip-mahasiswa', compact('mahasiswa', 'transkrip'));
    }

    public function krs(Request $req, $id)
    {
        $this->authorize('admin-prodi');

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

            $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $periodeNow[0])
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah')
                    ->get();

            $periodeAkt = $periodeNow[0]['id_periode'];
        }

        return view('backend.prodi.mahasiswa.krs-mahasiswa', compact('mahasiswa', 'krs', 'periodeNow', 'periodeAkt'));
    }


    public function histori_nilai(Request $req, $id)
    {
        $this->authorize('admin-prodi');

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

            $histori = RNM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', $periodeNow[0])
                    ->select('id_matkul', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah', 'nilai_angka', 'nilai_huruf', 'nilai_indeks')
                    ->addSelect(DB::raw('(SELECT kode_mata_kuliah from pd_feeder_mata_kuliah where pd_feeder_riwayat_nilai_mahasiswa.id_matkul = id_matkul) as kode_mata_kuliah'))
                    ->get();

            $periodeAkt = $periodeNow[0]['id_periode'];

        }

        // dd($histori);
        return view('backend.prodi.mahasiswa.histori-nilai', compact('mahasiswa', 'periodeNow','histori', 'periodeAkt'));
    }

    public function prestasi($id)
    {
        $this->authorize('admin-prodi');

        $mahasiswa = BiodataMahasiswa::where('id_mahasiswa', $id)
                    ->select('id_mahasiswa','nama_mahasiswa', 'tempat_lahir', 'jenis_kelamin', 'tanggal_lahir', 'nama_agama')->first();

        $prestasi = LPM::where('id_mahasiswa', $id)
                    ->select('nama_jenis_prestasi', 'nama_tingkat_prestasi', 'nama_prestasi', 'tahun_prestasi', 'penyelenggara', 'peringkat')
                    ->get();

        return view('backend.prodi.mahasiswa.prestasi-mahasiswa', compact('mahasiswa', 'prestasi'));

    }

}
