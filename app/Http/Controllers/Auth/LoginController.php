<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }

    // Customize the credentials method if needed
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    // Override attemptLogin to include 'remember' functionality
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    // Ensure guest middleware is applied, except for logout
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}


