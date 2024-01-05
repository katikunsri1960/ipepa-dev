<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Services\ApiService;
use Illuminate\Bus\Batchable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class FetchProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $db, $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($db, $page)
    {
        $this->db = $db;
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $act = $this->db['api_path'];
        $service = new ApiService($act, $this->page);
        $response = $service->runWs();

        $databases = DB::table($this->db['table_name']);

        if ($databases->first() && $this->page == 1) {

            Schema::disableForeignKeyConstraints();
            $databases->truncate();
            Schema::enableForeignKeyConstraints();

        }

        if (isset($response['data'])) {
            $data = array_chunk($response['data'], 500);

            foreach ($data as $item) {
                $databases->insert($item);
            }
        }

        // $databases->insert($data);
        $this->db->where('id', $this->db['id'])->update(['last_sync' => Carbon::now()]);
    }
}
