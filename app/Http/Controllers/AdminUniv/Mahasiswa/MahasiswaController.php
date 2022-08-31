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
use App\Models\PDUnsri\Feeder\Semester;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $mahasiswa =

        $mahasiswa = ListMahasiswa::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_mahasiswa.nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%');
            }
            if ($req->angkatan!='') {
                $q->whereIn('id_periode', $req->angkatan);
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
            if ($req->status!='') {
                $q->whereIn('nama_status_mahasiswa', $req->status);
            }
            if ($req->jk!='') {
                $q->whereIn('jenis_kelamin', $req->jk);
            }
            if ($req->agama!='') {
                $q->whereIn('id_agama', $req->agama);
            }
        })
        ->select('pd_feeder_list_mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa','pd_feeder_list_mahasiswa.id_mahasiswa as id_mahasiswa',
         'pd_feeder_list_mahasiswa.nama_mahasiswa as nama_mahasiswa', 'pd_feeder_list_mahasiswa.nim as nim', 'pd_feeder_list_mahasiswa.jenis_kelamin as jenis_kelamin',
            'pd_feeder_list_mahasiswa.nama_agama as nama_agama', 'pd_feeder_list_mahasiswa.total_sks as total_sks', 'pd_feeder_list_mahasiswa.tanggal_lahir as tanggal_lahir',
            'pd_feeder_list_mahasiswa.nama_program_studi as nama_program_studi',
            'pd_feeder_list_mahasiswa.nama_status_mahasiswa as nama_status_mahasiswa', 'pd_feeder_list_mahasiswa.id_periode as id_periode')
        ->addSelect(DB::raw('(SELECT SUM(sks_mata_kuliah) from pd_feeder_transkrip_mahasiswa where id_registrasi_mahasiswa = pd_feeder_list_mahasiswa.id_registrasi_mahasiswa) as total'))
        ->paginate(20);

        $val = $req;

        // dd($mahasiswa);

        return view('backend.univ.mahasiswa.index', compact('mahasiswa', 'status', 'agama', 'angkatan', 'jk', 'val', 'prodi'));
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
                ->select('nim', 'nama_jenis_daftar', 'nama_periode_masuk', 'tanggal_daftar', 'nama_program_studi', 'nama_perguruan_tinggi')->get();
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

    public function krs($id)
    {
        $this->authorize('admin-univ');

        $mahasiswa = ListMahasiswa::where('id_mahasiswa', $id)->select('id_mahasiswa', 'id_registrasi_mahasiswa','nama_mahasiswa', 'nim', 'nama_program_studi', 'id_periode as angkatan')->first();

        $krs = KM::where('id_registrasi_mahasiswa', $mahasiswa->id_registrasi_mahasiswa)
                    ->where('id_periode', '20201')
                    ->select('kode_mata_kuliah', 'nama_mata_kuliah', 'nama_kelas_kuliah', 'sks_mata_kuliah')
                    ->get();

        $tahun = range(Carbon::now()->year, Carbon::now()->year-10);

        $periode = Semester::whereIn('id_tahun_ajaran', $tahun)->select('id_semester', 'nama_semester')->orderBy('id_semester', 'desc')->get();

        return view('backend.univ.mahasiswa.krs-mahasiswa', compact('mahasiswa', 'krs', 'periode'));
    }

}
