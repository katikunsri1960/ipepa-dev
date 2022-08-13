<?php

namespace App\Http\Controllers\AdminProdi\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use App\Models\PDUnsri\Feeder\BiodataMahasiswa;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa;
use App\Models\RolesUser;

class MahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');
        $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $data = ListMahasiswa::where('id_prodi', $prodiId);
        $mahasiswa = $data
            ->when($req->has('keyword'), function($q) use($req){
                if ($req->keyword != '') {
                    $q->where('nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                    ->orWhere('nim', 'like', '%'.$req->keyword.'%')
                    ->orWhere('nama_program_studi', 'like', '%'.$req->keyword.'%');
                }
            })
            ->select('id_mahasiswa','nama_mahasiswa', 'nim', 'jenis_kelamin',
                'nama_agama', 'total_sks', 'tanggal_lahir', 'nama_program_studi',
                'nama_status_mahasiswa', 'id_periode')->paginate(20);

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

}
