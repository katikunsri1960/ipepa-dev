<?php

namespace App\Http\Controllers\AdminProdi\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PDUnsri\Feeder\Dosen\AktivitasMengajarDosen;
use App\Models\PDUnsri\Feeder\Dosen\DetailBiodataDosen;
use App\Models\PDUnsri\Feeder\Dosen\DetailPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListBimbingMahasiswa;
use App\Models\PDUnsri\Feeder\Dosen\ListDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListPenugasanDosen;
use App\Models\PDUnsri\Feeder\Dosen\ListUjiMahasiswa;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatFungsionalDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPangkatDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPendidikanDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatPenelitianDosen;
use App\Models\PDUnsri\Feeder\Dosen\RiwayatSertifikasiDosen;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\RolesUser;

class DosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $db = new (ListDosen::class);

        // $db = new (ListDosen::class);
        // $status = $db->select('id_status_aktif', 'nama_status_aktif')->distinct()->get();
        $status = ListDosen::select('id_status_aktif', 'nama_status_aktif')->distinct()->get();
        $jk = $db->select('jenis_kelamin')->distinct()->get();
        $agama = Agama::select('id_agama','nama_agama')->get();
        $val = $req;

        $dosen = $db->select('pd_feeder_list_dosen.id_dosen as id_dosen',
        'pd_feeder_list_dosen.nama_dosen as nama_dosen', 'pd_feeder_list_dosen.nidn as nidn', 'pd_feeder_list_dosen.jenis_kelamin as jenis_kelamin',
        'pd_feeder_list_dosen.nama_agama as nama_agama', 'pd_feeder_list_dosen.tanggal_lahir as tanggal_lahir', 'pd_feeder_list_dosen.nama_status_aktif as nama_status_aktif')
        ->groupBy('pd_feeder_list_dosen.id_dosen','pd_feeder_list_dosen.nama_dosen', 'pd_feeder_list_dosen.nidn', 'pd_feeder_list_dosen.jenis_kelamin','pd_feeder_list_dosen.nama_agama', 'pd_feeder_list_dosen.tanggal_lahir', 'pd_feeder_list_dosen.nama_status_aktif')
        ->when($req->has('p') || $req->has('keyword') || $req->has('status') || $req->has('jk') || $req->has('agama'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_dosen.nama_dosen', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nidn', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_dosen.nip', 'like', '%'.$req->keyword.'%');
            }
            if ($req->status) {
                $q->whereIn('id_status_aktif', $req->status);
            }
            if ($req->jk) {
                $q->whereIn('jenis_kelamin', $req->jk);
            }
            if ($req->agama!='') {
                $q->whereIn('id_agama', $req->agama);
            }
        })
        ->paginate($req->p != '' ? $req->p : 20);
        // dd($dosen);
        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.prodi.dosen.index', compact('dosen', 'status', 'val', 'jk', 'agama','paginate', 'valPaginate'));
    }

    public function detail($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        // $aktivitas = AktivitasKuliahMahasiswa::where('id_mahasiswa', $id)->get();
        return view('backend.prodi.dosen.detail-dosen', compact('dosen'));
    }

    public function penugasan($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $penugasan_dosen = DetailPenugasanDosen::where('id_dosen', $id)->select('id_tahun_ajaran','nama_tahun_ajaran', 'nama_program_studi', 'nomor_surat_tugas', 'tanggal_surat_tugas', 'mulai_surat_tugas')
        ->addSelect(DB::raw('(SELECT CONCAT(kode_perguruan_tinggi," - ",nama_perguruan_tinggi) FROM pd_feeder_perguruan_tinggi WHERE id_perguruan_tinggi = pd_feeder_detail_penugasan_dosen.id_perguruan_tinggi LIMIT 1) AS perguruan_tinggi'))->orderBy('id_tahun_ajaran', 'ASC')->get();

        return view('backend.prodi.dosen.detail-penugasan-dosen', compact('dosen','penugasan_dosen'));
    }

    public function aktivitas_mengajar($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $aktivitas_mengajar_dosen = AktivitasMengajarDosen::where('id_dosen', $id)->select('nama_periode','nama_program_studi', 'nama_kelas_kuliah', 'rencana_minggu_pertemuan', 'realisasi_minggu_pertemuan')
        ->addSelect(DB::raw('(SELECT CONCAT(kode_mata_kuliah," - ",nama_mata_kuliah) FROM pd_feeder_mata_kuliah WHERE id_matkul = pd_feeder_aktivitas_mengajar_dosen.id_matkul LIMIT 1) AS mata_kuliah'))->orderBy('id_periode', 'ASC')->get();

        return view('backend.prodi.dosen.aktivitas-mengajar-dosen', compact('dosen','aktivitas_mengajar_dosen'));
    }

    public function riwayat_fungsional($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_fungsional = RiwayatFungsionalDosen::where('id_dosen', $id)->select('nama_jabatan_fungsional','sk_jabatan_fungsional', 'mulai_sk_jabatan')->get();

        return view('backend.prodi.dosen.riwayat-fungsional-dosen', compact('dosen','riwayat_fungsional'));
    }

    public function riwayat_kepangkatan($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_pangkat = RiwayatPangkatDosen::where('id_dosen', $id)->select('nama_pangkat_golongan','sk_pangkat','tanggal_sk_pangkat','mulai_sk_pangkat', DB::raw('CONCAT(masa_kerja_dalam_tahun," thn ",masa_kerja_dalam_bulan," bln") AS masa_kerja'))->get();

        return view('backend.prodi.dosen.riwayat-kepangkatan-dosen', compact('dosen','riwayat_pangkat'));
    }

    public function riwayat_pendidikan($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_pendidikan = RiwayatPendidikanDosen::where('id_dosen', $id)->select('nama_bidang_studi','nama_jenjang_pendidikan','nama_gelar_akademik','nama_perguruan_tinggi','fakultas','tahun_lulus','sks_lulus','ipk')->get();

        return view('backend.prodi.dosen.riwayat-pendidikan-dosen', compact('dosen','riwayat_pendidikan'));
    }

    public function riwayat_sertifikasi($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_sertifikasi = RiwayatSertifikasiDosen::where('id_dosen', $id)->select('*')->get();

        return view('backend.prodi.dosen.riwayat-sertifikasi-dosen', compact('dosen','riwayat_sertifikasi'));
    }

    public function riwayat_penelitian($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $riwayat_penelitian = RiwayatPenelitianDosen::where('id_dosen', $id)->select('*')->get();

        return view('backend.prodi.dosen.riwayat-penelitian-dosen', compact('dosen','riwayat_penelitian'));
    }

    public function pembimbing_mahasiswa($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $pembimbing_mahasiswa = ListBimbingMahasiswa::join('pd_feeder_list_anggota_aktivitas_mahasiswa','pd_feeder_list_bimbing_mahasiswa.id_aktivitas','pd_feeder_list_anggota_aktivitas_mahasiswa.id_aktivitas')->join('pd_feeder_list_aktivitas_mahasiswa','pd_feeder_list_bimbing_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')->where('id_dosen', $id)->whereIn('id_kategori_kegiatan',array('110601','110401','110402','110403','110404','110405','110406','110407','110408'))->select('pd_feeder_list_anggota_aktivitas_mahasiswa.nim','pd_feeder_list_anggota_aktivitas_mahasiswa.nama_mahasiswa','pd_feeder_list_aktivitas_mahasiswa.nama_jenis_aktivitas','pd_feeder_list_anggota_aktivitas_mahasiswa.judul','pd_feeder_list_aktivitas_mahasiswa.tanggal_sk_tugas','pd_feeder_list_bimbing_mahasiswa.pembimbing_ke')->get();

        return view('backend.prodi.dosen.pembimbing-aktivitas-mahasiswa', compact('dosen','pembimbing_mahasiswa'));
    }

    public function penguji_mahasiswa($id)
    {
        $this->authorize('admin-prodi');

        $dosen = DetailBiodataDosen::where('id_dosen',$id)->select('*')
                ->addSelect(DB::raw('(SELECT nama_wilayah FROM pd_feeder_wilayah WHERE id_wilayah = pd_feeder_detail_biodata_dosen.id_wilayah LIMIT 1) AS kecamatan'))
                ->addSelect(DB::raw('(SELECT id_ikatan_kerja FROM pd_feeder_list_penugasan_dosen WHERE id_dosen = pd_feeder_detail_biodata_dosen.id_dosen AND id_tahun_ajaran=2022 LIMIT 1) AS ikatan_kerja'))->first();

        $penguji_mahasiswa = ListUjiMahasiswa::join('pd_feeder_list_anggota_aktivitas_mahasiswa','pd_feeder_list_uji_mahasiswa.id_aktivitas','pd_feeder_list_anggota_aktivitas_mahasiswa.id_aktivitas')->join('pd_feeder_list_aktivitas_mahasiswa','pd_feeder_list_uji_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')->where('id_dosen', $id)->whereIn('id_kategori_kegiatan',array('110500','110501','110502'))->select('pd_feeder_list_anggota_aktivitas_mahasiswa.nim','pd_feeder_list_anggota_aktivitas_mahasiswa.nama_mahasiswa','pd_feeder_list_aktivitas_mahasiswa.nama_jenis_aktivitas','pd_feeder_list_anggota_aktivitas_mahasiswa.judul','pd_feeder_list_aktivitas_mahasiswa.tanggal_sk_tugas','pd_feeder_list_uji_mahasiswa.penguji_ke')->get();

        return view('backend.prodi.dosen.penguji-aktivitas-mahasiswa', compact('dosen','penguji_mahasiswa'));
    }
}
