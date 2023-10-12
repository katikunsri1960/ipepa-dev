<?php

namespace App\Http\Controllers\AdminProdi;

use App\Models\DayaTampung;
use App\Models\JalurUjian;
use App\Models\Peminat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayaTampungPeminatController extends Controller
{
    public function index()
    {
        $this->authorize('admin-prodi');
        $fakprod = auth()->user()->roles_user->fak_prod_id;

        $tahun = DayaTampung::select('tahun')->distinct()->get();
        $tahunPeminat = Peminat::select('tahun')->distinct()->get();
        $dayaTampung = DayaTampung::where('id_prodi', $fakprod)->get()->groupBy('jalur_ujian_id');

        $peminatSnbp = Peminat::where('id_prodi', $fakprod)->get()->groupBy('jalur_ujian_id');

        return view('backend.prodi.daya-tampung-peminat', [
            'tahun' => $tahun,
            'tahunPeminat' => $tahunPeminat,
            'dayaTampung' => $dayaTampung,
            'peminatSnbp' => $peminatSnbp,
        ]);
    }
}
