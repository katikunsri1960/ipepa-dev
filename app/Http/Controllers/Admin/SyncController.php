<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Sync\SyncTableRequest;
use App\Models\SyncTable;

class SyncController extends Controller
{

    public function index(Request $req)
    {
        $this->authorize('admin');

        if ($req->ajax()) {

            $data = (SyncTable::select('name', 'table_name', 'api_path', 'last_sync')->get())->toJson();

            return $data;
        }

        return view('backend.admin.sync.index');
    }

    public function sync(Request $req)
    {
        $this->authorize('admin');


        if ($req->ajax()) {

            $act = SyncTable::value('api_path');
            $page = 0;
            $service = new ApiService($act, $page);
            $response = $service->runWs();

            return $response;

        }
    }

    public function create()
    {
        return view('backend.admin.sync.create');
    }

    public function store(SyncTableRequest $req)
    {
        $this->authorize('admin');
        //store data from api to database
        SyncTable::create($req->validated());

        return view('backend.admin.sync.index')->with('success', 'Data berhasil disimpan');

    }

    public function delete($id)
    {

    }
}
