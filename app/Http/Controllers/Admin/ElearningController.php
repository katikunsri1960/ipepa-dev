<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElearningAccount as Elearning;
use Illuminate\Support\Facades\Storage;

class ElearningController extends Controller
{
    public function index()
    {
        $data = Elearning::all();

        return view('backend.admin.elearning', [
            'data' => $data
        ]);
    }

    // show file
    public function showFile($id)
    {
        $data = Elearning::find($id);

        return response()->file(storage_path('app/' . $data->kpm));
    }

    // create`
    public function createAll()
    {
        $data = Elearning::where('created', 0)->get();
        // dd($data);
        $act = 'core_user_create_users';
        foreach ($data as $d) {

            $parameters = [
                'username' => $d->nim,
                'firstname' => strtoupper($d->nama_depan),
                'lastname' => strtoupper($d->nama_belakang),
                'email' => $d->email
            ];

            $create = new \App\Services\ElearningCreate($act, $parameters);
            $store = $create->runWs();
            if ($store == true) {
               $d->update(['created' => 1]);
            } else {
                return redirect()->back()->with('error', 'Data gagal dibuat!');
            }

        }

        return redirect()->back()->with('success', 'Data berhasil dibuat!');
    }

    // delete
    public function delete($id)
    {
        $data = Elearning::find($id);
        // delete file from storage
        $path = storage_path('app/' . $data->kpm);

        if (file_exists($path)) {
            unlink($path);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
