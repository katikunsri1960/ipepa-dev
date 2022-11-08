<?php

namespace App\Http\Controllers\AdminProdi\Pelengkap;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Pelengkap\ListPeriodePerkuliahan;
use App\Models\PDUnsri\Feeder\Pelengkap\DetailPeriodePerkuliahan;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use App\Models\RolesUser;
use Illuminate\Http\Request;

class PeriodePerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = ListPeriodePerkuliahan::leftJoin('pd_feeder_program_studi','pd_feeder_program_studi.id_prodi','pd_feeder_list_periode_perkuliahan.id_prodi');

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();
        $semester = Semester::select('id_semester', 'nama_semester')->get();
        $val = $req;

        $periode_kuliah = $data->when($req->has('keyword') || $req->has('prodi') || $req->has('semester'), function($q) use($req){
            if ($req->keyword != '') {
                $q->where('pd_feeder_list_periode_perkuliahan.nama_program_studi', 'like', '%'.$req->keyword.'%')
                ->orWhere('pd_feeder_list_periode_perkuliahan.nama_semester', 'like', '%'.$req->keyword.'%');
            }
            if ($req->prodi!='') {
                $q->whereIn('id_prodi', $req->prodi);
            }
            if ($req->semester!='') {
                $q->whereIn('id_semester', $req->semester);
            }
        })
        ->select('id_semester', 'pd_feeder_list_periode_perkuliahan.id_prodi', 'pd_feeder_list_periode_perkuliahan.nama_program_studi', 'nama_semester', 'jumlah_target_mahasiswa_baru', 'tanggal_awal_perkuliahan','tanggal_akhir_perkuliahan','pd_feeder_program_studi.status')->where('pd_feeder_list_periode_perkuliahan.id_prodi',$prodiId)->paginate(20);

        return view('backend.prodi.pelengkap.periode-perkuliahan.index', compact('periode_kuliah','prodi','semester','val'));
    }

    public function detail($prodi,$semester)
    {
        $this->authorize('admin-prodi');

        $data = new(DetailPeriodePerkuliahan::class);

        $detail_periode_kuliah = $data->where('id_prodi',$prodi)->where('id_semester',$semester)
                ->select('nama_program_studi', 'nama_semester', 'jumlah_target_mahasiswa_baru', 'jumlah_pendaftar_ikut_seleksi','jumlah_pendaftar_lulus_seleksi', 'jumlah_daftar_ulang','jumlah_mengundurkan_diri','jumlah_minggu_pertemuan','tanggal_awal_perkuliahan','tanggal_akhir_perkuliahan')->get();


        return view('backend.prodi.pelengkap.periode-perkuliahan.detail', compact('detail_periode_kuliah'));
    }
}
