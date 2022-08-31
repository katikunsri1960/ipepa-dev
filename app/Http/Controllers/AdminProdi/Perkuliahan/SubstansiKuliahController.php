<?php

namespace App\Http\Controllers\AdminProdi\Perkuliahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubstansiKuliahController extends Controller
{
    public function index()
    {
        return view('backend.prodi.perkuliahan.substansi-kuliah.index');
    }
}
