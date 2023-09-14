<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElearningAccount as Elearning;
use App\Models\ElearningDelete;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ElearningDeleteImport as ElearningImport;
use App\Services\ElearningService;
use App\Services\StarSender;

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

        if ($data->count() == 0) {
            return redirect()->back()->with('error', 'Tidak ada data yang dapat dibuat!');
        }

        $act = 'core_user_create_users';

        $pesan = "Akun anda sudah diverifikasi dan selesai dibuat di E-learning. \nInformasi tentang *Username* dan *Password* dapat dilihat pada E-mail Institusi anda.".
                "\n\nJika mengalami kesulitan untuk login email institusi anda melalui handphone, silahkan coba login melalui PC/Laptop.".
                "\nJika masih terdapat masalah login *E-mail*, silahkan hubungi ICT di Student Center Lt.4 Indralaya atau KPA Lt. 3 Palembang.".
                "\n\n\nhttps://elearning.unsri.ac.id \nTerima Kasih";

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

                if ($d->no_wa != null) {
                    $send = new StarSender($d->no_wa, $pesan);
                    $send->sendWa();
                }

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

    public function delete_all_created()
    {
        $data = Elearning::where('created', 1)->get();

        if ($data->count() > 0) {
            foreach ($data as $d) {
                $path = storage_path('app/' . $d->kpm);

                if (file_exists($path)) {
                    unlink($path);
                }

                $d->delete();
            }
        }

        return redirect()->back()->with('success', 'Semua Data berhasil dihapus!');
    }

    public function delete_account()
    {
        $data = ElearningDelete::all();

        return view('backend.admin.elearning-delete', [
            'data' => $data
        ]);
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $req->file('file');

        $import = Excel::import(new ElearningImport, $file);

        if (!$import) {

            return redirect()->back()->with('error', 'Data gagal diimport!');
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function delete_account_all()
    {
        $data = ElearningDelete::where('deleted', 0)->get();
        $act = 'core_user_get_users_by_field';
        $deleteAct = 'core_user_delete_users';

        if ($data->count() > 0) {
            foreach ($data as $d) {

                $parameters = $d->nim.'@student.unsri.ac.id';
                $elearning = new ElearningService($act, $parameters);

                $result = $elearning->runWs();

                if ($result != false) {
                    // dd($result[0]['id']);
                    $delete = new ElearningService($deleteAct, $result[0]['id']);
                    $delete->deleteWs();

                }

                $d->update(['deleted' => 1]);
            }
        }

        return true;
    }

    public function remove_data()
    {
        ElearningDelete::where('deleted', 1)->truncate();

        return redirect()->back()->with('success', 'Semua Data berhasil dihapus!');
    }

    public function tes_sendwa(Request $req)
    {
        $data = $req->validate([
            'pesan' => 'required',
            'tujuan' => 'required'
        ]);

        $tujuan = $data['tujuan'];
        $pesan = $data['pesan'];

        $send = new StarSender($tujuan, $pesan);

        $send->sendWa();

         return redirect()->back()->with('success', 'Pesan Berhasil dikirim!');
    }
}
