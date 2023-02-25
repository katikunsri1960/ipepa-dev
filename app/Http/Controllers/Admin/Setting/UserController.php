<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\RolesUser;
use Illuminate\Support\Facades\DB;
use App\Models\PDUnsri\Feeder\ProgramStudi;

class UserController extends Controller
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

            $users = (User::leftJoin('roles', 'users.role_id', 'roles.id')->leftJoin('roles_users as ru', 'users.id', 'ru.user_id')
                        ->leftJoin('pd_feeder_program_studi as ps', 'ru.fak_prod_id', 'ps.id_prodi')
                        ->select('users.id as id','users.name as name', 'email', 'users.role_id as role_id', 'username', 'roles.name as role',
                                'ps.nama_jenjang_pendidikan as jenjang', 'ps.nama_program_studi as prodi')
                        ->get())->toJson();

            return $users;

        }

        return view('backend.admin.setting.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        $roles = Role::all();
        return view('backend.admin.setting.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('admin');
        $data = $request->validated();
        // dd($data);
        DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => $data['password'],
                'role_id' => $data['role_id'],
            ]);

            if ($data['role_id'] == 4) {
                RolesUser::create([
                    'user_id' => $user->id,
                    'role_id' => $data['role_id'],
                    'fak_prod_id' => $data['fak_prodi'],
                ]);
            }
        });

        // User::create($request->validated());

        return redirect()->route('admin.settings.users.index')->with('success', 'User has been created');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin');
        $user = User::findOrFail($id);
        $roles = Role::all();
        $prodi = ProgramStudi::all();

        // dd($user->role_id);

        return view('backend.admin.setting.user.edit', compact('user', 'roles', 'prodi'));

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
        $user = User::findOrFail($id);

        DB::transaction(function () use ($request, $data, $user, $id) {

            if ($data['password'] == '') {
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'username' => 'required|string|max:255',
                    'role_id' => 'required|integer',
                ]);
                $data['password'] = $user->password;

            } else {

                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'username' => 'required|string|max:255',
                    'password' => 'required|string|min:6|confirmed',
                    'role_id' => 'required|integer',
                ]);

                $data['password'] = $data['password'];
            }


            $user->update($data);

            if ($data['role_id'] == 4) {
                RolesUser::where('user_id',$id)->updateOrCreate([
                    // 'user_id' => $user->id,
                    'role_id' => $data['role_id'],
                    'fak_prod_id' => $data['fak_prodi'],
                ]);
            } else {
                RolesUser::where('user_id',$id)->delete();
            }
        });

        return redirect()->route('admin.settings.users.index')->with('success', 'User has been updated');

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

        DB::transaction(function () use ($id) {

            $user = User::findOrFail($id);
            $roleUser = RolesUser::where('user_id',$id)->first();
            if ($roleUser) {
                $roleUser->delete();
            }
            $user->delete();
        });

        return redirect()->route('admin.settings.users.index')->with('success', 'User has been deleted');

    }
}
