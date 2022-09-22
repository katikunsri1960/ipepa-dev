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

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->get();
        // $angkatan = $data->select('angkatan')->distinct()->get();
        $semester = Semester::select('id_semester', 'nama_semester')->orderBy('id_semester', 'desc')->get();
        $val = $req;

        $aktivitas_mahasiswa = $data->when($req->has('keyword') || $req->has('prodi') || $req->has('semester'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_aktivitas_mahasiswa.nama_semester', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_aktivitas_mahasiswa.nama_prodi', 'like', '%'.$req->keyword.'%');
            }
            if ($req->semester!='') {
                $q->whereIn('id_semester', $req->semester);
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
        })
        ->select('id_aktivitas', 'id_prodi', 'id_semester', 'nama_prodi', 'nama_semester', 'nama_jenis_aktivitas','judul', 'tanggal_sk_tugas')
        ->paginate(20);
        return view('backend.univ.perkuliahan.aktivitas-mahasiswa.index', compact('aktivitas_mahasiswa','prodi','semester','val'));
    }

    public function detail($id)
    {
        $this->authorize('admin-univ');

        // $detail = ListAktivitasMahasiswa::where('id_mahasiswa',$id)
        // ->select('id_mahasiswa', 'id_semester', 'nama_semester', 'nim', 'nama_mahasiswa','angkatan', 'nama_program_studi', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')
        // ->paginate(20);
        return view('backend.univ.perkuliahan.aktivitas-kuliah-mahasiswa.detail', compact(''));
    }
}
