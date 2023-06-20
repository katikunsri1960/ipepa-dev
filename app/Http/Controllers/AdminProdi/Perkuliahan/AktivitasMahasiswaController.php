<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use App\Models\PDUnsri\Feeder\Dosen\ListAktivitasMahasiswa;
use App\Models\PDUnsri\Feeder\ProgramStudi;
use App\Models\PDUnsri\Feeder\Semester;
use Illuminate\Http\Request;
use App\Models\RolesUser;
use Illuminate\Support\Facades\DB;

class AktivitasMahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $aktivitas = DB::table('pd_feeder_jenis_aktivitas_mahasiswa')->select('id_jenis_aktivitas_mahasiswa', 'nama_jenis_aktivitas_mahasiswa')->get();

        $prodi = ProgramStudi::select('id_prodi', 'nama_program_studi', 'nama_jenjang_pendidikan')->where('pd_feeder_program_studi.id_prodi',$prodiId)->get();

        // $prodi = $data->select('pd_feeder_list_aktivitas_mahasiswa.id_prodi', 'pd_feeder_list_aktivitas_mahasiswa.nama_prodi')->distinct()->orderBy('nama_prodi')->get();
        $semester_now = Semester::select('pd_feeder_semester.id_semester', 'pd_feeder_semester.nama_semester')->where('a_periode_aktif', 1)->get();
        $now = $semester_now->max('id_semester');

        $semester= Semester::select('nama_semester', 'id_semester', 'id_tahun_ajaran')->where('id_semester', '<=', $now )->orderBy('nama_semester','DESC')->get();
        $val = $req;

        return view('backend.prodi.perkuliahan.aktivitas-mahasiswa.index', compact('val','prodi','semester', 'aktivitas'));
    }

    public function am_data(Request $request)
    {

        $this->authorize('admin-prodi');

        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $searchValue = $request->input('search.value');
        $columns = ['id_aktivitas','nama_prodi', 'id_semester', 'nama_jenis_aktivitas', 'judul', 'tanggal_sk_tugas'];
        $column = $columns[$request->input('order.0.column')];
        $direction = $request->input('order.0.dir');

        $query = DB::table('pd_feeder_list_aktivitas_mahasiswa')
                    ->select('id_aktivitas', 'id_semester','id_prodi', 'nama_prodi', 'nama_semester', 'nama_jenis_aktivitas','judul', 'tanggal_sk_tugas')
                    ->where('id_prodi', $prodiId);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('judul', 'LIKE', '%'.$searchValue.'%')
                    ->orWhere('nama_prodi', 'LIKE', '%'.$searchValue.'%');
            });
        }

        if ($request->has('prodi') && !empty($request->input('prodi'))) {
            $prodi = $request->input('prodi');
            $query->whereIn('id_prodi', $prodi);
        }

        if ($request->has('semester') && !empty($request->input('semester'))) {
            $semester = $request->input('semester');
            $query->whereIn('id_semester', $semester);
        }

        $recordsFiltered = $query->count();
        $query->orderBy($column, $direction);

        // limit and offset
        $limit = $request->input('length');
        $offset = $request->input('start');
        $query->skip($offset)->take($limit);

         // get data
        $data = $query->get();

        $recordsTotal = DB::table('pd_feeder_list_aktivitas_mahasiswa')->where('id_prodi', $prodiId)->count();

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
        $this->authorize('admin-prodi');

        $data = ListAktivitasMahasiswa::leftJoin('pd_feeder_list_anggota_aktivitas_mahasiswa','pd_feeder_list_anggota_aktivitas_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')
        // ->leftJoin('pd_feeder_list_bimbing_mahasiswa', 'pd_feeder_list_bimbing_mahasiswa.id_aktivitas', 'pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')
        // ->leftJoin('pd_feeder_dosen_pembimbing', 'pd_feeder_dosen_pembimbing.id_dosen', 'pd_feeder_list_bimbing_mahasiswa.id_dosen')
        ->leftJoin('pd_feeder_list_uji_mahasiswa','pd_feeder_list_uji_mahasiswa.id_aktivitas','pd_feeder_list_aktivitas_mahasiswa.id_aktivitas');
        // ->select('*');

        $pem = ListAktivitasMahasiswa::leftJoin('pd_feeder_list_bimbing_mahasiswa', 'pd_feeder_list_bimbing_mahasiswa.id_aktivitas', 'pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')
        // ->leftJoin('pd_feeder_dosen_pembimbing', 'pd_feeder_dosen_pembimbing.id_dosen', 'pd_feeder_list_aktivitas_mahasiswa.id_dosen')
        ;

        $det = ListAktivitasMahasiswa::leftJoin('pd_feeder_list_bimbing_mahasiswa', 'pd_feeder_list_bimbing_mahasiswa.id_aktivitas', 'pd_feeder_list_aktivitas_mahasiswa.id_aktivitas')
                                        ->leftJoin('pd_feeder_dosen_pembimbing', 'pd_feeder_dosen_pembimbing.id_dosen', 'pd_feeder_list_bimbing_mahasiswa.id_dosen')
                                        ->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)
        ;

        $detail = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->distinct()->select('nama_prodi', 'nama_semester', 'sk_tugas', 'tanggal_sk_tugas', 'nama_jenis_aktivitas', 'nama_jenis_anggota', 'pd_feeder_list_aktivitas_mahasiswa.judul', 'keterangan', 'lokasi', 'pd_feeder_list_anggota_aktivitas_mahasiswa.nim', 'pd_feeder_list_anggota_aktivitas_mahasiswa.nama_mahasiswa', 'jenis_peran', 'nama_jenis_peran')->get();
        // $detail = $det->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->distinct()->select('nama_prodi', 'nama_semester', 'sk_tugas', 'tanggal_sk_tugas', 'nama_jenis_aktivitas', 'nama_jenis_anggota', 'judul', 'keterangan', 'lokasi')->get();
        // $detail = $det->distinct()->select('*')->get();


        // $pembimbing = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->select('nidn', 'nama_dosen', 'pembimbing_ke', 'jenis_aktivitas')->orderBy('pembimbing_ke')->get();
        $pembimbing = $pem->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->select('*')->orderBy('pembimbing_ke')->get();
        $penguji = $data->where('pd_feeder_list_aktivitas_mahasiswa.id_aktivitas',$id)->select('pd_feeder_list_uji_mahasiswa.nidn', 'pd_feeder_list_uji_mahasiswa.nama_dosen', 'penguji_ke', 'nama_kategori_kegiatan')->orderBy('penguji_ke')->get();
// dd($detail);
        // ->select('id_mahasiswa', 'id_semester', 'nama_semester', 'nim', 'nama_mahasiswa','angkatan', 'nama_program_studi', 'nama_status_mahasiswa', 'ips', 'ipk', 'sks_semester', 'sks_total')
        // ->paginate(20);
        return view('backend.prodi.perkuliahan.aktivitas-mahasiswa.detail', compact('detail', 'pembimbing', 'penguji'));
    }
}


