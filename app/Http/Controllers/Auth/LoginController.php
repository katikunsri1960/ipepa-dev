<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $req)
    {
        $input = $req->all();

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            if (auth()->user()->role_id == Role::ADMINISTRATOR) {
                return redirect()->route('admin.dashboard-admin');
            } else if (auth()->user()->role_id == Role::ADMIN_UNIVERSITAS) {
                return redirect()->route('admin-univ.dashboard-admin-univ');
            } else if(auth()->user()->role_id == Role::ADMIN_FAKULTAS){
                return redirect()->route('admin-fakultas.dashboard-admin-fakultas');
            } else if(auth()->user()->role_id == Role::ADMIN_PRODI){
                return redirect()->route('admin-prodi.dashboard-admin-prodi');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username or password is incorrect');
        }

    }
}
