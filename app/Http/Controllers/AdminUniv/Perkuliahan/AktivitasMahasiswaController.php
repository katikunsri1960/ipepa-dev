<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Dosen\ListAktivitasMahasiswa;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use Illuminate\Http\Request;

class AktivitasMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $data = new(ListAktivitasMahasiswa::class);

        $prodi = $data->select('pd_feeder_list_aktivitas_mahasiswa.id_prodi', 'pd_feeder_list_aktivitas_mahasiswa.nama_prodi')->distinct()->orderBy('nama_prodi')->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');

        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->limit(50)->get();
        $semester_aktif = $semester->toArray();
        $val = $req;

        if ($req->has('semester') || $req->has('prodi'))  {
            $aktivitas_mahasiswa = $data->select('id_aktivitas', 'pd_feeder_list_aktivitas_mahasiswa.id_prodi', 'id_semester', 'nama_prodi', 'nama_semester', 'nama_jenis_aktivitas','judul', 'tanggal_sk_tugas')
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_aktivitas_mahasiswa.judul', 'like', '%'.$req->keyword.'%')
                // ->orWhere('pd_feeder_list_aktivitas_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                // ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ;
            }

            //semester
            if ($req->semester!='') {
                $q->whereIn('nama_semester', $req->semester);
            }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);
        }

        else {
            $aktivitas_mahasiswa = $data->select('id_aktivitas', 'pd_feeder_list_aktivitas_mahasiswa.id_prodi', 'id_semester', 'nama_prodi', 'nama_semester', 'nama_jenis_aktivitas','judul', 'tanggal_sk_tugas')
            ->where('nama_semester', $semester_aktif[0]['nama_semester'])
            ->when($req->has('keyword') || $req->has('semester') || $req->has('prodi')  || $req->has('angkatan') || $req->has('status_mahasiswa'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_aktivitas_mahasiswa.judul', 'like', '%'.$req->keyword.'%')
                // ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                // ->orWhere('pd_feeder_aktivitas_kuliah_mahasiswa.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ;
            }

            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }

            })
            ->paginate($req->p != '' ? $req->p : 20);

        }

        if ($req->has('p') && $req->p != '') {
            $valPaginate = $req->p;
        } else $valPaginate = 20;

        $paginate = [20,50,100,200,500];

        return view('backend.univ.perkuliahan.aktivitas-mahasiswa.index', compact('aktivitas_mahasiswa','prodi','val','prodi',
        'semester', 'semester_aktif', 'paginate', 'valPaginate'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        $data = ListAktivitasMahasiswa::leftJoin('pd_feeder_list_anggota_aktivitas_mahasiswa','pd_feeder_list_anggota_aktivitas_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')
        ->leftJoin('pd_feeder_dosen_pembimbing','pd_feeder_dosen_pembimbing.id_registrasi_mahasiswa','pd_feeder_list_anggota_aktivitas_mahasiswa.id_registrasi_mahasiswa')
        ->leftJoin('pd_feeder_list_uji_mahasiswa','pd_feeder_list_uji_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas');

        $detail = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->distinct()->select('nama_prodi', 'nama_semester', 'sk_tugas', 'tanggal_sk_tugas', 'nama_jenis_aktivitas', 'nama_jenis_anggota', 'pd_feeder_list_aktivitas_mahasiswa.judul', 'keterangan', 'lokasi', 'pd_feeder_list_anggota_aktivitas_mahasiswa.nim', 'pd_feeder_list_anggota_aktivitas_mahasiswa.nama_mahasiswa', 'jenis_peran', 'nama_jenis_peran')->get();
        // dd($detail);
        $pembimbing = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->select('pd_feeder_dosen_pembimbing.nidn', 'pd_feeder_dosen_pembimbing.nama_dosen', 'pembimbing_ke', 'jenis_aktivitas')->get();
        $penguji = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->select('pd_feeder_list_uji_mahasiswa.nidn', 'pd_feeder_list_uji_mahasiswa.nama_dosen', 'penguji_ke', 'nama_kategori_kegiatan')->get();

        // ->select('id_mahasiswa', 'id_semester', 'nama_semester', 'nim', 'nama_mahasiswa','angkatan', 'nama_program_studi', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')
        // ->paginate(20);
        return view('backend.univ.perkuliahan.aktivitas-mahasiswa.detail', compact('detail', 'pembimbing', 'penguji'));
    }
}


