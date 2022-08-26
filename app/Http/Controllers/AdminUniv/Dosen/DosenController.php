<?php

namespace App\Http\Controllers\AdminUniv\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Dosen\AktivitasMengajarDosen;
use App\Models\PDUnsri\Feeder\Dosen\DetailBiodataDosen;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatFungsionalDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPangkatDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPendidikanDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPenelitianDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatSertifikasiDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $dosen =

        $dosen = ListDosen::when($req->has('keyword'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nidn', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nip', 'like', '%'.$req->keyword.'%');
            }
        })
        ->select('pd_feeder_list_dosen.id_dosen as id_dosen',
         'pd_feeder_list_dosen.nama_dosen as nama_dosen', 'pd_feeder_list_dosen.nidn as nidn', 'pd_feeder_list_dosen.jenis_kelamin as jenis_kelamin',
            'pd_feeder_list_dosen.nama_agama as nama_agama', 'pd_feeder_list_dosen.tanggal_lahir as tanggal_lahir', 'pd_feeder_list_dosen.nama_status_aktif as nama_status_aktif')->paginate(20);

        // dd($mahasiswa);

        return view('backend.univ.dosen.index', compact('dosen'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        // $aktivitas = AktivitasKuliahMahasiswa::where('id_mahasiswa', $id)->get();
        return view('backend.univ.dosen.detail-dosen', compact('dosen'));
    }

    public function penugasan($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $penugasan_dosen = DetailPenugasanDosen::where('id_dosen', $id)->select('id_tahun_ajaran','nama_tahun_ajaran', 'nama_program_studi', 'nomor_surat_tugas', 'tanggal_surat_tugas', 'mulai_surat_tugas')
        ->addSelect(DB::raw('(SELECT CONCAT(kode_perguruan_tinggi," - ",nama_perguruan_tinggi) FROM pd_feeder_perguruan_tinggi WHERE id_perguruan_tinggi = pd_feeder_detail_penugasan_dosen.id_perguruan_tinggi LIMIT 1) AS perguruan_tinggi'))->orderBy('id_tahun_ajaran', 'ASC')->get();

        return view('backend.univ.dosen.detail-penugasan-dosen', compact('dosen','penugasan_dosen'));
    }

    public function aktivitas_mengajar($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $aktivitas_mengajar_dosen = AktivitasMengajarDosen::where('id_dosen', $id)->select('nama_periode','nama_program_studi', 'nama_kelas_kuliah', 'rencana_minggu_pertemuan', 'realisasi_minggu_pertemuan')
        ->addSelect(DB::raw('(SELECT CONCAT(kode_mata_kuliah," - ",nama_mata_kuliah) FROM pd_feeder_mata_kuliah WHERE id_matkul = pd_feeder_aktivitas_mengajar_dosen.id_matkul LIMIT 1) AS mata_kuliah'))->orderBy('id_periode', 'ASC')->get();

        return view('backend.univ.dosen.aktivitas-mengajar-dosen', compact('dosen','aktivitas_mengajar_dosen'));
    }

    public function riwayat_fungsional($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_fungsional = RiwayatFungsionalDosen::where('id_dosen', $id)->select('nama_jabatan_fungsional','sk_jabatan_fungsional', 'mulai_sk_jabatan')->get();

        return view('backend.univ.dosen.riwayat-fungsional-dosen', compact('dosen','riwayat_fungsional'));
    }

    public function riwayat_kepangkatan($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_pangkat = RiwayatPangkatDosen::where('id_dosen', $id)->select('nama_pangkat_golongan','sk_pangkat','tanggal_sk_pangkat','mulai_sk_pangkat', DB::raw('CONCAT(masa_kerja_dalam_tahun," thn ",masa_kerja_dalam_bulan," bln") AS masa_kerja'))->get();

        return view('backend.univ.dosen.riwayat-kepangkatan-dosen', compact('dosen','riwayat_pangkat'));
    }

    public function riwayat_pendidikan($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_pendidikan = RiwayatPendidikanDosen::where('id_dosen', $id)->select('nama_bidang_studi','nama_jenjang_pendidikan','nama_gelar_akademik','nama_perguruan_tinggi','fakultas','tahun_lulus','sks_lulus','ipk')->get();

        return view('backend.univ.dosen.riwayat-pendidikan-dosen', compact('dosen','riwayat_pendidikan'));
    }

    public function riwayat_sertifikasi($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_sertifikasi = RiwayatSertifikasiDosen::where('id_dosen', $id)->select('*')->get();

        return view('backend.univ.dosen.riwayat-sertifikasi-dosen', compact('dosen','riwayat_sertifikasi'));
    }

    public function riwayat_penelitian($id)
    {
        $this->authorize('admin-univ');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_penelitian = RiwayatPenelitianDosen::where('id_dosen', $id)->select('*')->get();

        return view('backend.univ.dosen.riwayat-penelitian-dosen', compact('dosen','riwayat_penelitian'));
    }
}
