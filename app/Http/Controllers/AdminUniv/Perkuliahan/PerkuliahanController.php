<?php

namespace App\Http\Controllers\AdminUniv\Perkuliahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkuliahanController extends Controller
{
    public function index()
    {
        $this->authorize('admin-univ');

        return view('backend.univ.perkuliahan.daftar-mata-kuliah');
    }
}
