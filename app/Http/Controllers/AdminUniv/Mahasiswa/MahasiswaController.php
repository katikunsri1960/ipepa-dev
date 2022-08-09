<?php

namespace App\Http\Controllers\AdminUniv\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDUnsri\Feeder\ListMahasiswa;
use Illuminate\Support\Facades\DB;
use App\Models\PDUnsri\Feeder\Mahasiswa\AktivitasKuliahMahasiswa as AKM;

class MahasiswaController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-univ');

        $mahasiswa = 

        $mahasiswa = ListMahasiswa::when($req->has('keyword'), function($q) use($req){

            $q->where('nama_mahasiswa', 'like', '%'.$req->keyword.'%')
                ->orWhere('nim', 'like', '%'.$req->keyword.'%')
                ->orWhere('nama_program_studi', 'like', '%'.$req->keyword.'%');

        })->select('nama_mahasiswa', 'nim', 'jenis_kelamin',
                'nama_agama', 'total_sks', 'tanggal_lahir', 'nama_program_studi',
                'nama_status_mahasiswa', 'id_periode')->paginate(20);

        return view('backend.univ.mahasiswa.index', compact('mahasiswa'));
    }


}
