<?php

namespace App\Http\Controllers\AdminProdi\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
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
}
