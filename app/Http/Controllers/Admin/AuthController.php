<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $request;
    private $auth;

    public function __construct(Request $request, Auth $auth)
    {
        $this->request = $request;
        $this->auth = $auth;
    }

    public function login()
    {

        if ($this->auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard'));
        }


        return view('admin.auth.login');
    }

    public function do_login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->auth::guard('admin')->attempt($credentials, $request->has('remember'))) {
            return redirect(route('admin.dashboard'));
        }


        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('trs.error_logging'),
            ]);
    }

}
