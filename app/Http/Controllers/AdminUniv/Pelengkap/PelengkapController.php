<?php

namespace App\Http\Controllers\AdminUniv\Pelengkap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelengkapController extends Controller
{
    public function skala_nilai()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.pelengkap.skala-nilai');
    }

    public function periode_perkuliahan()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.pelengkap.pengaturan-periode-perkuliahan');
    }

}
