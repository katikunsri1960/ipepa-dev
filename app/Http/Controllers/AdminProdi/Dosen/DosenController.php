<?php

namespace App\Http\Controllers\AdminProdi\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolesUser;
use App\Models\PDUnsri\Feeder\Dosen\ListDosen;

class DosenController extends Controller
{
    public function index(Request $req)
    {
        $this->authorize('admin-prodi');

        // $prodiId = RolesUser::where('user_id', auth()->user()->id)->value('fak_prod_id');

        $dosen = ListDosen::select('id_dosen', 'nama_dosen', 'nidn', 'jenis_kelamin', 'nama_agama', 'nama_status_aktif', 'tanggal_lahir')->get();

        return view('backend.prodi.dosen.index', compact('dosen'));
    }
}
