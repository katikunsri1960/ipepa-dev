<?php

namespace App\Http\Controllers\Admin;

use App\Models\DayaTampung;
use App\Models\JalurUjian;
use App\Models\Peminat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DtImport as DtImport;
use App\Imports\PeminatImport as PeminatImport;

class DayaTampungPeminatController extends Controller
{
    public function index()
    {
        $tahun = DayaTampung::select('tahun')->distinct()->get();
        $tahunPeminat = Peminat::select('tahun')->distinct()->get();
        $dayaTampung = DayaTampung::where('jalur_ujian_id', 1)->get()->groupBy('id_prodi');
        $snbt = DayaTampung::where('jalur_ujian_id', 2)->get()->groupBy('id_prodi');

        $peminatSnbp = Peminat::where('jalur_ujian_id', 1)->get()->groupBy('id_prodi');
        $peminatSnbt = Peminat::where('jalur_ujian_id', 2)->get()->groupBy('id_prodi');
        // dd($dayaTampung);
        // foreach ($dayaTampung as $d => $v) {
        //     dd($v[0]->JalurUjian->nama);
        // }
        return view('backend.admin.daya-tampung-peminat', [
            'tahun' => $tahun,
            'tahunPeminat' => $tahunPeminat,
            'dayaTampung' => $dayaTampung,
            'snbt' => $snbt,
            'peminatSnbp' => $peminatSnbp,
            'peminatSnbt' => $peminatSnbt,
        ]);
    }

    public function import_dt(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $req->file('file');

        $import = Excel::import(new DtImport, $file);

        if (!$import) {

            return redirect()->back()->with('error', 'Data gagal diimport!');
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function import_peminat(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $req->file('file');

        $import = Excel::import(new PeminatImport, $file);

        if (!$import) {

            return redirect()->back()->with('error', 'Data gagal diimport!');
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }
}
