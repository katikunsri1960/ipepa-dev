<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Sync\SyncTableRequest;
use App\Models\SyncTable;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use App\Jobs\FetchProcess;
use App\Services\ApiService;
use Illuminate\Support\Arr;

class AjaxSyncController extends Controller
{
    public function sync(Request $req)
    {
        $this->authorize('admin');

        if ($req->ajax()) {
            $dbs = SyncTable::select(
                'id',
                'api_path',
                'table_name',
                'last_sync'
            )->get();

            $batch = Bus::batch([])->dispatch();

            foreach ($dbs as $db) {
                $act = $db['api_path'];
                $page = 1;
                $service = new ApiService($act, $page);
                $response = $service->runWs();

                //cek apakah ada pagination
                if (
                    Arr::exists($response, 'meta') &&
                    $response['meta']['last_page'] > 1
                ) {
                    $lastpage = $response['meta']['last_page'];

                    for ($i = 1; $i <= $lastpage; $i++) {
                        $page = $i;
                        $batch->add(new FetchProcess($db, $page));
                    }
                } else {
                    $batch->add(new FetchProcess($db, $page));
                }
            }

            return $batch;
        }
    }

    public function syncSelected(Request $req)
    {
        $this->authorize('admin');

        if ($req->ajax()) {
            $selected = request('id');

            $dbs = SyncTable::select(
                'id',
                'api_path',
                'table_name',
                'last_sync'
            )
                ->whereIn('id', $selected)
                ->get();

            $batch = Bus::batch([])->dispatch();

            foreach ($dbs as $db) {
                $act = $db['api_path'];
                $page = 1;
                $service = new ApiService($act, $page);
                $response = $service->runWs();

                if (
                    array_key_exists("meta", $response) &&
                    $response['meta']['last_page'] > 1
                ) {
                    $lastpage = $response['meta']['last_page'];

                    for ($i = 1; $i <= $lastpage; $i++) {
                        $page = $i;
                        $batch->add(new FetchProcess($db, $page));
                    }
                } else {
                    $batch->add(new FetchProcess($db, $page));
                }

                SyncTable::where('id', $db['id'])->update(['batch_id' => $batch->id]);
            }
            return $batch;
        }
    }

    public function syncProcess(Request $req)
    {
        if ($req->ajax()) {
            $batchId = request('id');
            return Bus::findBatch($batchId);
        }
    }
}
