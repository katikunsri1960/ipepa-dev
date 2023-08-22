<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
{
    public function index()
    {
        $data = DB::connection('reg_con')->table('reg_master')->select('rm_nim', 'rm_nama', 'rm_nik', 'rm_nik_perbaikan')->limit(10)->get();
        dd($data);
        return view('backend.univ.check-reg.index');
    }

    public function data(Request $req)
    {

    }
}
