<?php

namespace App\Http\Controllers\AdminUniv;

use App\Models\DayaTampung;
use App\Models\JalurUjian;
use App\Models\Peminat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayaTampungPeminatController extends Controller
{
    public function index()
    {
        $this->authorize('admin-univ');

        $tahun = DayaTampung::select('tahun')->distinct()->get();
        $tahunPeminat = Peminat::select('tahun')->distinct()->get();
        $dayaTampung = DayaTampung::where('jalur_ujian_id', 1)->get()->groupBy('id_prodi');
        $snbt = DayaTampung::where('jalur_ujian_id', 2)->get()->groupBy('id_prodi');
        $usmb = DayaTampung::where('jalur_ujian_id', 3)->get()->groupBy('id_prodi');

        $peminatSnbp = Peminat::where('jalur_ujian_id', 1)->get()->groupBy('id_prodi');
        $peminatSnbt = Peminat::where('jalur_ujian_id', 2)->get()->groupBy('id_prodi');

        return view('backend.univ.daya-tampung-peminat', [
            'tahun' => $tahun,
            'tahunPeminat' => $tahunPeminat,
            'dayaTampung' => $dayaTampung,
            'snbt' => $snbt,
            'peminatSnbp' => $peminatSnbp,
            'peminatSnbt' => $peminatSnbt,
            'usmb' => $usmb,
        ]);
    }
}
