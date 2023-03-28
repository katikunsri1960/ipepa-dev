<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyncTable;
use App\Http\Requests\Sync\SyncTableRequest;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $this->authorize('admin');

        if ($req->ajax()) {

            $data = (SyncTable::select('id','name', 'table_name', 'api_path', 'last_sync')->get())->toJson();

            return $data;
        }

        return view('backend.admin.sync.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.sync.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SyncTableRequest $request)
    {
        $this->authorize('admin');
        //store data from api to database
        SyncTable::create($request->validated());

        return redirect()->route('admin.sync.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SyncTable::findOrFail($id);

        return view('backend.admin.sync.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SyncTableRequest $request, $id)
    {
        $this->authorize('admin');
        $data = SyncTable::findOrFail($id);
        $data->update($request->validated());

        return redirect()->route('admin.sync.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('admin');

        $user = SyncTable::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.sync.index')->with('success', 'Data has been deleted');
    }

    public function dnp()
    {
        $this->authorize('admin');
        $count = DB::connection('pdunsri')->table('detail_nilai_perkuliahan')->count();
        
        $limit = 50000;
        $offset = 0;

        $check = DB::table('pd_feeder_detail_nilai_perkuliahan')->count();

        if ($check > 0) {
            DB::table('pd_feeder_detail_nilai_perkuliahan')->truncate();
        }

        for ($i=0; $i < $count; $i+50000) { 
            $data = DB::connection('pdunsri')->table('detail_nilai_perkuliahan')->offset($offset)->limit($limit)->get();
            
            //convert object to array
            $data = json_decode(json_encode($data), true);

            $chunk = array_chunk($data, 1000);
            //insert data to database
            foreach ($chunk as $k) {
                DB::table('pd_feeder_detail_nilai_perkuliahan')->insert($k);
            }

            $offset += $limit;
        }

        return redirect()->route('admin.sync.index')->with('success', 'Data berhasil disinkronisasi');
        
    }

}
