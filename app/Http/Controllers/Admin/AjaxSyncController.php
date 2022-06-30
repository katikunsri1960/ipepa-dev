<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Sync\SyncTableRequest;
use App\Models\SyncTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class AjaxSyncController extends Controller
{

    public function sync(Request $req)
    {
        $this->authorize('admin');


        if ($req->ajax()) {

            $dbs = SyncTable::select('id','api_path', 'table_name', 'last_sync')->get();

            $messages = [];

            foreach ($dbs as $db) {

                $act = $db['api_path'];
                $page = 0;
                $service = new ApiService($act, $page);
                $response = $service->runWs();

                $databases = DB::table($db['table_name']);

                if ($databases->first() && $page == 0) {

                    Schema::disableForeignKeyConstraints();
                    $databases->truncate();
                    Schema::enableForeignKeyConstraints();

                }

                if(count($response['data']) > 1000){
                    $data = array_chunk($response['data'], 1000);
                    
                    foreach ($data as $dataChunk) {
                        $databases->insert($dataChunk);
                    }

                } else {

                    $databases->insert($response['data']);

                }


                $db->where('id', $db['id'])->update(['last_sync' => Carbon::now()]);


                $message = 'Sync ' . $db['table_name'] . ' Success';

                $messages[] = $message;

                // response()->json(['status' => 'success', 'message' => $message])->send();


            }

            $result = [
                'status' => 'success',
                'message' => $messages,
            ];

            return $result;

        }
    }
}
