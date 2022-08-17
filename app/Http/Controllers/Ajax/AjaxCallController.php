<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxCallController extends Controller
{
    public function callAkm(Request $req)
    {
        $this->authorize('admin_prodi');

        if ($req->ajax()) {
            // query

            // return hasil query
        }
    }
}
