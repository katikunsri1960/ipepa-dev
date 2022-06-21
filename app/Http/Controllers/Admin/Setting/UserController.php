<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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

            $users = (User::leftJoin('roles', 'users.role_id', 'roles.id')
                        ->select('users.id as id','users.name as name', 'email', 'role_id', 'username', 'roles.name as role')
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
    public function store(Request $request)
    {
        $this->authorize('admin');

        $data = $request->all();
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|integer',
        ]);

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->role_id = $data['role_id'];
        $user->save();

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

        return view('backend.admin.setting.user.edit', compact('user', 'roles'));

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
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

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

        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.settings.users.index')->with('success', 'User has been deleted');

    }
}
