<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpepaController extends Controller
{
    public function dosen()
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');
        $prodi = $con->table('program_studi')->orderBy('kode_program_studi')->get();
        $ikatan = $con->table('sister_ikatan_kerja')->get();
        $tahunSekarang = $con->table('semester')->where('id_tahun_ajaran', '<=', date('Y'))
                                ->select('id_tahun_ajaran')
                                ->distinct()
                                ->orderBy('id_tahun_ajaran', 'desc')
                                ->get();

        // dd($tahunSekarang);
        return view('backend.univ.ipepa.dosen', compact('ikatan', 'prodi', 'tahunSekarang'));
    }

    public function dosen_data(Request $req)
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');

        $val = $this->validate($req, [
            'semester' => 'required',
            'ikatan' => 'required',
            'prodi' => 'required'
        ]);

        $ts = $val['semester'];
        $ikatan = $val['ikatan'];
        $fakprod = $val['prodi'];

        $con = DB::connection('pd_con');
        $semester = $con->table('semester')
                    ->select('id_semester')
                    ->where('id_tahun_ajaran', $ts)
                    ->pluck('id_semester');

        //make semester into ()
        $semester = '('.$semester->implode(', ').')';
        $nama_ikatan = $con->table('sister_ikatan_kerja')
                    ->select('nama')
                    ->where('id', $ikatan)
                    ->first();

        //change value $val['ikatan'] into $nama_ikatan in $val['ikatan']
        $val['ikatan'] = $nama_ikatan->nama;


        $gelar = "(SELECT GROUP_CONCAT(gelar_akademik SEPARATOR '; ')
                    FROM sister_list_pendidikan_formal as pf WHERE pf.id_sdm = list_dosen.id_dosen) as gelar_akademik";
        $prodi = "(SELECT GROUP_CONCAT(p.id_unit_kerja SEPARATOR ', ')
                    FROM sister_detail_penugasan as p
                    WHERE p.id_sdm = list_dosen.id_dosen AND p.tanggal_surat_tugas = (SELECT MAX(tanggal_surat_tugas)
                        FROM sister_detail_penugasan WHERE id_sdm = list_dosen.id_dosen)) as id_unit_kerja";

        $jf = "(SELECT GROUP_CONCAT(jf.jabatan_fungsional SEPARATOR ', ')
                    FROM sister_detail_jabatan_fungsional as jf
                    WHERE jf.id_sdm = list_dosen.id_dosen AND jf.tanggal_mulai = (SELECT MAX(tanggal_mulai)
                        FROM sister_detail_jabatan_fungsional WHERE id_sdm = list_dosen.id_dosen)) as jabfung";

        $join = "(
            SELECT id_prodi
            FROM program_studi
            WHERE id_prodi = (
                SELECT GROUP_CONCAT(p.id_unit_kerja SEPARATOR ', ')
                FROM sister_detail_penugasan as p
                WHERE p.id_sdm = list_dosen.id_dosen
                AND p.tanggal_surat_tugas = (
                    SELECT MAX(tanggal_surat_tugas)
                    FROM sister_detail_penugasan
                    WHERE id_sdm = list_dosen.id_dosen
                ))
            )";

        $join2 = "(
                    SELECT id_list FROM sister_detail_penugasan
                    WHERE id_sdm = (
                    SELECT GROUP_CONCAT(p.id_sdm SEPARATOR ', ')
                    FROM sister_detail_penugasan as p
                    WHERE p.id_sdm = list_dosen.id_dosen
                    AND p.tanggal_surat_tugas = (
                        SELECT MAX(tanggal_surat_tugas)
                        FROM sister_detail_penugasan
                        WHERE id_sdm = list_dosen.id_dosen
                    ))
                )";


        // $mk = "(SELECT GROUP_CONCAT(CONCAT(dkk.kode_mata_kuliah,' - ',dkk.nama_mata_kuliah, ' (', dkk.nama_kelas_kuliah, ')', ' TA ', dkk.nama_semester, ' $' , dkk.sks) SEPARATOR '^*^ ')
        //         FROM dosen_pengajar_kelas_kuliah as dpkk
        //         JOIN list_kelas_kuliah as dkk ON dpkk.id_kelas_kuliah = dkk.id_kelas_kuliah
        //         WHERE dpkk.id_dosen = list_dosen.id_dosen AND dpkk.id_semester IN ".$semester.") as nama_mk";

        // $mk = "(SELECT GROUP_CONCAT(CONCAT(dpkk.mata_kuliah, ' (', dpkk.kelas, ')', ' TA ', dpkk.semester, ' $' , dpkk.sks) SEPARATOR '^*^ ')
        //         FROM sister_list_pengajaran as dpkk
        //         WHERE dpkk.id_sdm = list_dosen.id_dosen AND dpkk.semester IN ".$semester.") as nama_mk";

         $mk = "(SELECT GROUP_CONCAT(CONCAT(dkk.mata_kuliah,' - ', ' (', dkk.kelas, ')', ' TA ', dkk.semester, ' $' , dkk.sks) SEPARATOR '^*^ ')
                FROM sister_list_pengajaran as dpkk
                JOIN sister_detail_pengajaran as dkk ON dpkk.id = dkk.id_list
                WHERE dpkk.id_sdm = list_dosen.id_dosen AND dkk.id_semester IN ".$semester.") as nama_mk";

        // $jf = "(SELECT GROUP_CONCAT(jf.jabatan_fungsional SEPARATOR ', ')
        //         FROM sister_detail_penugasan as p
        //         WHERE p.id_sdm = list_dosen.id_dosen AND p.tanggal_surat_tugas = (SELECT MAX(tanggal_surat_tugas)
        //             FROM sister_detail_penugasan WHERE id_sdm = list_dosen.id_dosen)) as jabatan_fungsional";

        $data = $con->table('list_dosen')
                    ->select('list_dosen.*', $con->raw($gelar), $con->raw($prodi), 'program_studi.*', $con->raw($mk), $con->raw($jf))
                    ->leftJoin('program_studi', 'program_studi.id_prodi', '=', $con->raw($join))
                    ->leftJoin('sister_detail_penugasan', 'sister_detail_penugasan.id_sdm', '=', 'list_dosen.id_dosen')
                    ->where('sister_detail_penugasan.id_ikatan_kerja', '=', $ikatan)
                    ->where('program_studi.id_prodi', $fakprod)
                    ->get();

        //make $mk to array
        foreach ($data as $key => $value) {
            $mk = explode('^*^ ', $value->nama_mk);
            $jafung = explode(', ', $value->jabfung);
            if (count($jafung) > 1) {
                $data[$key]->jabfung = $jafung[0];
            }
            $sks = [];
            $bksa = [];
            //ordering $mk asc
            sort($mk);

            for ($i=0; $i < count($mk); $i++) {
                $sks = explode(' $', $mk[$i]);
                if ($sks[0] == '') {
                    $mk[$i] = 'Tidak ada data mata kuliah';
                }else {
                    $mk[$i] = $sks[0];
                }
                if(count($sks) > 1){
                    $bksa[$i] = $sks[1];
                } else {
                    $bksa[$i] = 'Tidak ada data sks';
                }


            }
            // dd($bksa);
            $gelar = explode('; ', $value->gelar_akademik);
            $data[$key]->gelar_akademik = $gelar;
            $data[$key]->nama_mk = $mk;
            $data[$key]->sks = $bksa;
        }

        //return data
        return response()->json(['data' => $data]);
    }

    public function regular_transfer()
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');
        $prodi = $con->table('program_studi')->orderBy('kode_program_studi')->get();
        $tahunSekarang = $con->table('semester')->where('id_tahun_ajaran', '<=', date('Y'))
                                ->select('id_tahun_ajaran')
                                ->distinct()
                                ->orderBy('id_tahun_ajaran', 'desc')
                                ->get();
        return view('backend.univ.ipepa.regular-transfer', compact('prodi', 'tahunSekarang'));
    }

    public function regular_transfer_data(Request $request)
    {
        $this->authorize('admin-univ');

        $con = DB::connection('pd_con');

        $fakprod = $request->prodi;
        $tahunSekarang = $request->semester;
        $tahunAwal = $tahunSekarang - 4;

        $jalurReg = [0,1,15];
        $jalurTrf = [11,13,16];

        // $negara = "(SELECT id_negara from biodata_mahasiswa as bm WHERE bm.id_mahasiswa = list_riwayat_pendidikan_mahasiswa.id_mahasiswa) as id_negara";

        // $data = $con->table('list_riwayat_pendidikan_mahasiswa')->select('list_riwayat_pendidikan_mahasiswa.*', $con->raw($negara))
        //             ->where('id_prodi', $fakprod)
        //             ->whereIn('id_jalur_daftar', $jalurReg)
        //             ->get();

        $hasil  = [];

        for ($i=$tahunAwal; $i <= $tahunSekarang; $i++) {

            $semester = $con->table('semester')->select('id_semester')->where('id_tahun_ajaran', $i)->pluck('id_semester');

            $hasil[] = [
                "tahun_akademik" => $i,
                "data" => [
                    'ganjil' => [
                        'reguler' => $con->table('list_mahasiswa')
                                        ->join('list_riwayat_pendidikan_mahasiswa as rm', 'rm.id_registrasi_mahasiswa', '=', 'list_mahasiswa.id_registrasi_mahasiswa')
                                        ->select('list_mahasiswa.*', 'rm.id_jenis_daftar as id_jenis_daftar', 'rm.nama_jenis_daftar as nama_jenis_daftar')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->whereIn('id_jenis_daftar', $jalurReg)->where('id_periode', $semester[0])->count(),
                        'transfer' => $con->table('list_mahasiswa')
                                        ->join('list_riwayat_pendidikan_mahasiswa as rm', 'rm.id_registrasi_mahasiswa', '=', 'list_mahasiswa.id_registrasi_mahasiswa')
                                        ->select('list_mahasiswa.*', 'rm.id_jenis_daftar as id_jenis_daftar', 'rm.nama_jenis_daftar as nama_jenis_daftar')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->whereIn('id_jenis_daftar', $jalurTrf)->where('id_periode', $semester[0])->count(),
                        'aktif' => $con->table('list_mahasiswa')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[0]);
                                        })->count(),
                        'lulus' => $con->table('list_mahasiswa')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->where('id_periode_keluar', $semester[0])
                                        ->where('id_status_mahasiswa', 1)
                                        ->count(),
                        'gagal' => $con->table('list_mahasiswa')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->where('id_periode_keluar', $semester[0])
                                        ->whereNOT(function ($query) {
                                            $query->where('id_status_mahasiswa', 1)
                                                    ->orWhere('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->count(),
                        ],
                    'genap' => [
                        'reguler' => $con->table('list_mahasiswa')
                                        ->join('list_riwayat_pendidikan_mahasiswa as rm', 'rm.id_registrasi_mahasiswa', '=', 'list_mahasiswa.id_registrasi_mahasiswa')
                                        ->select('list_mahasiswa.*', 'rm.id_jenis_daftar as id_jenis_daftar', 'rm.nama_jenis_daftar as nama_jenis_daftar')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->whereIn('id_jenis_daftar', $jalurReg)->where('id_periode', $semester[1])->count(),
                        'transfer' => $con->table('list_mahasiswa')
                                        ->join('list_riwayat_pendidikan_mahasiswa as rm', 'rm.id_registrasi_mahasiswa', '=', 'list_mahasiswa.id_registrasi_mahasiswa')
                                        ->select('list_mahasiswa.*', 'rm.id_jenis_daftar as id_jenis_daftar', 'rm.nama_jenis_daftar as nama_jenis_daftar')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->whereIn('id_jenis_daftar', $jalurTrf)->where('id_periode', $semester[1])->count(),
                        'aktif' => $con->table('list_mahasiswa')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[1]);
                                        })->count(),
                        'lulus' => $con->table('list_mahasiswa')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->where('id_periode_keluar', $semester[1])
                                        ->where('id_status_mahasiswa', 1)
                                        ->count(),
                        'gagal' => $con->table('list_mahasiswa')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->where('id_periode_keluar', $semester[1])
                                        ->whereNOT(function ($query) {
                                            $query->where('id_status_mahasiswa', 1)
                                                    ->orWhere('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->count(),
                        ]
                    ]
            ];
        }

        // dd($hasil);

        return response()->json(["data" => $hasil]);
    }

    public function mahasiswa_asing()
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');
        $prodi = $con->table('program_studi')->orderBy('kode_program_studi')->get();
        $tahunSekarang = $con->table('semester')->where('id_tahun_ajaran', '<=', date('Y'))
                                ->select('id_tahun_ajaran')
                                ->distinct()
                                ->orderBy('id_tahun_ajaran', 'desc')
                                ->get();
        return view('backend.univ.ipepa.mahasiswa-asing', compact('prodi', 'tahunSekarang'));
    }

    public function mahasiswa_asing_data(Request $request)
    {
        $this->authorize('admin-univ');
        $fakprod = $request->prodi;
        $con = DB::connection('pd_con');

        $tahunSekarang = $request->semester;
        $tahunAwal = $tahunSekarang - 4;

        $hasil  = [];

        for ($i=$tahunAwal; $i <= $tahunSekarang; $i++) {

            $semester = $con->table('semester')->select('id_semester')->where('id_tahun_ajaran', $i)->pluck('id_semester');

            $hasil[] = [
                "tahun_akademik" => $i,
                "data" => [
                    'ganjil' => [
                        'aktif' => $con->table('list_mahasiswa')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[0]);
                                        })->count(),
                        'asing_penuh' => $con->table('list_mahasiswa')
                                        ->join('biodata_mahasiswa as m', 'm.id_mahasiswa', 'list_mahasiswa.id_mahasiswa')
                                        ->select('list_mahasiswa.*', 'm.id_negara as id_negara')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF')
                                                ->where('id_negara', '!=', 'ID');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[0])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[0])
                                                ->where('id_negara', '!=', 'ID');
                                        })->count(),
                        'asing_paruh' => 0
                        ],
                    'genap' => [
                        'aktif' => $con->table('list_mahasiswa')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[1]);
                                        })->count(),
                        'asing_penuh' => $con->table('list_mahasiswa')
                                        ->join('biodata_mahasiswa as m', 'm.id_mahasiswa', 'list_mahasiswa.id_mahasiswa')
                                        ->select('list_mahasiswa.*', 'm.id_negara as id_negara')
                                        ->where(function ($query) use ($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('nama_status_mahasiswa', 'AKTIF')
                                                ->where('id_negara', '!=', 'ID');
                                        })
                                        ->orWhere(function ($query) use($semester, $fakprod) {
                                            $query->where('id_periode', '<=', $semester[1])
                                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                                ->where('id_status_mahasiswa', 1)
                                                ->where('id_periode_keluar', '>', $semester[1])
                                                ->where('id_negara', '!=', 'ID');
                                        })->count(),
                        'asing_paruh' => 0
                        ]
                    ]
            ];
        }

        // dd($hasil);

        return response()->json(["data" => $hasil]);
    }

    public function capaian_pembelajaran()
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');
        $prodi = $con->table('program_studi')->orderBy('kode_program_studi')->get();
        $tahunSekarang = $con->table('semester')->where('id_tahun_ajaran', '<=', date('Y'))
                                ->select('id_tahun_ajaran')
                                ->distinct()
                                ->orderBy('id_tahun_ajaran', 'desc')
                                ->get();
        return view('backend.univ.ipepa.ipk-lulusan', compact('prodi', 'tahunSekarang'));
    }

    public function capaian_pembelajaran_data(Request $request)
    {
        $this->authorize('admin-univ');

        $con = DB::connection('pd_con');
        $fakprod = $request->prodi;
        $tahunSekarang = $request->semester;
        $tahunAwal = $tahunSekarang - 4;

        $hasil  = [];

        for ($i=$tahunAwal; $i <= $tahunSekarang; $i++) {

            $semester = $con->table('semester')->select('id_semester')->where('id_tahun_ajaran', $i)->pluck('id_semester');

            $hasil[] = [
                "tahun_akademik" => $i,
                "jumlah_lulusan" => $con->table('list_mahasiswa')
                                        ->where('list_mahasiswa.id_prodi', $fakprod)
                                        ->whereIn('id_periode_keluar', $semester)
                                        ->where('id_status_mahasiswa', 1)
                                        ->count(),
                'min' => $con->table('list_mahasiswa')
                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                ->whereIn('id_periode_keluar', $semester)
                                ->where('id_status_mahasiswa', 1)->min('ipk'),
                'rata' => $con->table('list_mahasiswa')
                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                ->whereIn('id_periode_keluar', $semester)
                                ->where('id_status_mahasiswa', 1)->avg('ipk'),
                'max' => $con->table('list_mahasiswa')
                                ->where('list_mahasiswa.id_prodi', $fakprod)
                                ->whereIn('id_periode_keluar', $semester)
                                ->where('id_status_mahasiswa', 1)->max('ipk'),
            ];
        }

        return response()->json(["data" => $hasil]);
    }

    public function kohort_lulusan()
    {
        $this->authorize('admin-univ');
        $con = DB::connection('pd_con');
        $prodi = $con->table('program_studi')->orderBy('kode_program_studi')->get();
        $tahunSekarang = $con->table('semester')->where('id_tahun_ajaran', '<=', date('Y'))
                                ->select('id_tahun_ajaran')
                                ->distinct()
                                ->orderBy('id_tahun_ajaran', 'desc')
                                ->get();
        return view('backend.univ.ipepa.kohort.index', compact('prodi', 'tahunSekarang'));
    }

    public function kohort_lulusan_data(Request $request)
    {
        $this->authorize('admin-univ');
        $fakprod = $request->prodi;

        $tahunSekarang = $request->semester;
        $tahunAwal = $tahunSekarang - 5;
        $con = DB::connection('pd_con');
        $hasilPerhitungan = [];

        for ($tahun = $tahunAwal; $tahun <= $tahunSekarang; $tahun++) {
            // filter $data with left id periode masuk
            $jumlahMahasiswa = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->count();
            $lulus6TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 6)->count();
            $lulus5TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 5)->count();
            $lulus4TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 4)->count();
            $lulus3TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 3)->count();
            $lulus2TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 2)->count();
            $lulus1TahunLalu = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang - 1)->count();
            $ts = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereYear('tanggal_keluar', $tahunSekarang)->count();
            $lulusTahunIni = $lulus6TahunLalu+$lulus5TahunLalu+$lulus4TahunLalu+$lulus3TahunLalu+$lulus2TahunLalu+$lulus1TahunLalu+$ts;
            $rataMasaStudi = $con->table('list_riwayat_pendidikan_mahasiswa')->where('id_prodi', $fakprod)->where(DB::raw('LEFT(id_periode_masuk, 4)'), $tahun)->where('id_jenis_keluar', '1')->whereBetween(DB::raw('YEAR(tanggal_keluar)'), [$tahun, $tahunSekarang])->avg(DB::raw('DATEDIFF(tanggal_keluar, tanggal_daftar)'));

            $years = floor($rataMasaStudi / 365);
            $months = floor(($rataMasaStudi % 365) / 30);
            $days = ($rataMasaStudi % 365) % 30;

            $rataMasaStudi = $years.' tahun '.$months.' bulan '.$days.' hari';

            $hasilPerhitungan[] = [
                'tahun_masuk' => $tahun,
                'jumlah_mahasiswa' => $jumlahMahasiswa,
                'lulus_6_tahun_lalu' => $lulus6TahunLalu,
                'lulus_5_tahun_lalu' => $lulus5TahunLalu,
                'lulus_4_tahun_lalu' => $lulus4TahunLalu,
                'lulus_3_tahun_lalu' => $lulus3TahunLalu,
                'lulus_2_tahun_lalu' => $lulus2TahunLalu,
                'lulus_1_tahun_lalu' => $lulus1TahunLalu,
                'lulus_tahun_ini' => $ts,
                'total' => $lulusTahunIni,
                'rata_masa_studi' => $rataMasaStudi,
                'tahun_sekarang' => $tahunSekarang,
            ];
        }

        return response()->json(["data" => $hasilPerhitungan]);
    }


}