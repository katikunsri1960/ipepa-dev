<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiConfig;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');

        if ($request->ajax()) {

            $data = (ApiConfig::select('id', 'name','api_url', 'api_key')
                        ->get())->toJson();

            return $data;
        }

        return view('backend.admin.setting.api.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.setting.api.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin');

        $data = $request->all();
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'api_url' => 'required|string|max:255',
            'api_key' => 'required|string',
        ]);

        ApiConfig::create($data);

        return redirect()->route('admin.settings.api-configs.index')->with('success', 'Api Config created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ApiConfig::findOrFail($id);
        return view('backend.admin.setting.api.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin');
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'api_url' => 'required|string|max:255',
            'api_key' => 'required|string',]);

        $api_config = ApiConfig::findOrFail($id);
        $api_config->update($data);

        return redirect()->route('admin.settings.api-configs.index')->with('success', 'Api Config updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
