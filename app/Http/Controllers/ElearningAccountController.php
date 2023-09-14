<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ElearningService;
use Illuminate\Support\Facades\DB;
use App\Models\ElearningAccount;
use Ramsey\Uuid\Uuid;


class ElearningAccountController extends Controller
{
    public function form_elearning()
    {
        return view('frontend.form-elearning.index');
    }

    public function check_nim(Request $req)
    {
        $data = $req->validate([
            'nim' => 'required',
        ]);

        $nim = $req->nim;

        $check = ElearningAccount::where('nim', $nim)->first();

        if ($check) {

            if($check->created == 0){
                return response()->json([
                    'status' => 888,
                    'nim' => $req->nim,
                ]);
            }

            return response()->json([
                'status' => 999,
                'nim' => $req->nim,
            ]);
        }

        $act = 'core_user_get_users_by_field';

        $parameters = $nim.'@student.unsri.ac.id';

        $elearning = new ElearningService($act, $parameters);

        $result = $elearning->runWs();

        if (!empty($result)) {
            return response()->json([
                'status' => 200,
                'nim' => $req->nim,
            ]);
        }

        return response()->json([
            'status' => 404,
            'nim' => $req->nim,
        ]);


    }

    public function create($nim)
    {
        return view('frontend.form-elearning.create', ['nim' => $nim]);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'nim' => 'required|numeric',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required',
            'no_wa' => 'nullable|numeric',
            'kpm' => 'required|mimes:pdf,jpeg,png,jpg|max:5000',
        ]);

        $act = 'core_user_get_users_by_field';

        $parameters = $data['nim'].'@student.unsri.ac.id';

        $elearning = new ElearningService($act, $parameters);

        $result = $elearning->runWs();

        if (!empty($result)) {
            return redirect()->route('elearning')->with('status', 'Akun anda sudah terdaftar di E-learning, Silahkan Melakukan Forget Password/Lost Password!!');
        }

        if($req->hasFile('kpm')){
            // Get filename with the extension, and replace with uuid v4
            $fileName = Uuid::uuid4().'.'.$req->file('kpm')->extension();
            $data['kpm'] = $req->file('kpm')->storeAs('public/kpm', $fileName);

        }

        $store = ElearningAccount::create($data);

        if($store){
            return redirect()->route('elearning')->with('status', 'Berhasil Membuat Akun E-learning, Silahkan Tunggu 1x24 Jam Untuk Proses Verifikasi');
        }

    }
}
